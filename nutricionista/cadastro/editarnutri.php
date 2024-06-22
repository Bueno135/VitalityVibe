<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Verificar cadastro</title>
</head>
<body>
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE nutricionista SET nome=?, email=?, cpf=?, CRN=?, sexo=?, cep=?, formacao=? WHERE id_nutricionista=?");

    $stmt->bind_param("sssssisi", $nome, $email, $cpf, $CRN, $sexo, $cep, $formacao, $id_nutricionista);

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];
    $CRN = $_POST['CRN'];
    $cep = $_POST['cep'];
    $formacao = $_POST['formacao'];
    $id_nutricionista = $_SESSION['id'];

    if ($stmt->execute()) {
        echo "<script>
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Cadastro atualizado com sucesso',
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function() {
            window.location.href='/Projeto/telanutri.php';
        }, 1500);
        </script>";
    } else {
        echo "Erro ao atualizar o cadastro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
