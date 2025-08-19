<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Verificar cadastro</title></head>
<body>
<?php
require_once __DIR__ . '/../../bd/connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE cliente SET nome=?, email=?, cpf=?, dt_nasc=?, sexo=?, cep=?, telefone=? WHERE ID_cliente=?");

    $stmt->bind_param("ssssssss", $nome, $email, $cpf, $dt_nasc, $sexo, $cep, $telefone, $_SESSION['ID_cliente']);

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $dt_nasc = $_POST['dt_nasc'];
    $sexo = $_POST['sexo'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];

    if ($stmt->execute()) {
        echo "<script>Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Cadastro atualizado com sucesso',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/Cliente/tela.php'; // Redirecionar para login.php após o OK
        });</script>";
    } else {
        echo "Erro ao atualizar o cadastro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

?>
</body>
</html>
