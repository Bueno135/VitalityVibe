<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Verificar cadastro</title></head>
<body>
<?php
require_once __DIR__ . '/../../bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE nutricionista SET nome=?, email=?, cpf=?, dt_nasc=?, sexo=?, cep=?, especialidade=?, formacao=? WHERE id_nutricionista=?");


    $stmt->bind_param("sssssssssi", $nome, $email, $cpf, $dt_nasc, $sexo, $cep, $especialidade, $formacao, $id_nutricionista);

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $dt_nasc = $_POST['dt_nasc'];
    $sexo = $_POST['sexo'];
    $cep = $_POST['cep'];
    $especialidade = $_POST['especialidade'];
    $formacao = $_POST['formacao'];
   


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
        window.location.href='/Projeto/login/entrarnutri.php';
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