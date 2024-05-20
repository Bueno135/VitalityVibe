<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
=======
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
    <title>Verificar cadastro</title>
</head>
<body>
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

<<<<<<< HEAD
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE cliente SET nome=?, email=?, cpf=?, dt_nasc=?, sexo=?, cep=?, telefone=? WHERE ID_cliente=?");

    $stmt->bind_param("ssssssss", $nome, $email, $cpf, $dt_nasc, $sexo, $cep, $telefone, $_SESSION['ID_cliente']);
=======
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE cliente SET nome=?, email=?, cpf=?, dt_nasc=?, sexo=?, cep=?, problema_saude=?, alergias=?, altura=?, peso=?, telefone=?, med_controlado=? WHERE ID_cliente=?");


    $stmt->bind_param("ssssssssssssi", $nome, $email, $cpf, $dt_nasc, $sexo, $cep, $problema_saude, $alergias, $altura, $peso, $telefone, $med_controlado, $ID_cliente );
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $dt_nasc = $_POST['dt_nasc'];
    $sexo = $_POST['sexo'];
    $cep = $_POST['cep'];
<<<<<<< HEAD
    $telefone = $_POST['telefone'];

    if ($stmt->execute()) {
        echo "<script>Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Cadastro atualizado com sucesso',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/Projeto/tela.php'; // Redirecionar para login.php após o OK
        });</script>";
=======
    $problema_saude = $_POST['problema_saude'];
    $alergias = $_POST['alergias'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $telefone = $_POST['telefone'];
    $med_controlado = $_POST['med_controlado'];
    $ID_cliente = $_POST['ID_cliente'];


    if ($stmt->execute()) {
        echo "<script>Swal.fire({
            position: "top",
            icon: "sucess",
            title: "Cadastro atualizado com sucesso",
            showConfirmButton: false,
            timer: 1500
            });; window.location.href='/Projeto/login/entrarcliente.php';</script>";
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
    } else {
        echo "Erro ao atualizar o cadastro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

?>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
