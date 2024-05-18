<?php
session_start();
require '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM cliente WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verifica a senha usando password_verify
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta, faça o login
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $usuario['nome']; // Se 'nome' é o campo correto para o nome do cliente
            header('Location: /Projeto/tela.php');
            exit();
        } else {
            // Senha incorreta
            $erro = 'Erro de login';
        }
    } else {
        // Usuário não encontrado
        $erro = 'Erro de login';
    }
}

// Exibição de erro genérico
if (isset($erro)) {
    echo "<div class='message'>
        <p>{$erro}</p>
        </div><br>";
    echo "<a href='entrarcliente.php'>Voltar</a>";
}

