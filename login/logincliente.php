<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

$senha = "Senha";
$hash_armazenado_no_banco = "senhaHash";

if (password_verify($senha, $hash_armazenado_no_banco)) {
    echo "As senhas coincidem!";
} else {
    echo "As senhas não coincidem.";
}


$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $conn->prepare("SELECT * FROM cliente WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
        header("Location: /Projeto/index.php");
    } else {
        echo "Usuário ou senha incorretos";
    }
} else {
    echo "Usuário ou senha incorretos";
}

$stmt->close();
$conn->close();
?>
