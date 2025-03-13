<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar cadastro</title>
</head>
<body>
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE cliente SET problema_saude=?, alergias=?, altura=?, peso=?, med_controlado=? WHERE ID_cliente=?");


    $stmt->bind_param("ssssssssssssi", $problema_saude, $alergias, $altura, $peso, $med_controlado, $ID_cliente );

   
    $problema_saude = $_POST['problema_saude'];
    $alergias = $_POST['alergias'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $med_controlado = $_POST['med_controlado'];
    $ID_cliente = $_POST['ID_cliente'];


    if ($stmt->execute()) {
        echo "<script>Swal.fire({
            position: 'top',
            icon: 'sucess',
            title: 'Cadastro atualizado com sucesso',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/Projeto/tela.php'; // Redirecionar para login.php após o OK
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