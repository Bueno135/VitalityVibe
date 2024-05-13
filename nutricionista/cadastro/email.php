
<?php
include"/xampp/htdocs/Projeto/bd/connection.php";
$email = $_POST['email'];
$query = "SELECT * FROM cliente WHERE email = '$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo 'E-mail já cadastrado.';
} else {
    echo 'E-mail disponível para cadastro.';
}

$conn->close();
?>