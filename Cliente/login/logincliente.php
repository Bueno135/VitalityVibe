<?php
session_start();
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Adiciona um echo para verificar se os dados estão sendo recebidos
    // echo "Email: $email, Senha: $senha";

    $stmt = $conn->prepare("SELECT * FROM cliente WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Adiciona um echo para verificar o hash da senha no banco de dados
        // echo "Senha do banco de dados: " . $usuario['senha'];

        // Verifica a senha usando password_verify
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta, faça o login
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $usuario['nome']; // Se 'nome' é o campo correto para o nome do cliente
            header('Location: /Projeto/tela.php');
            exit();
        } else {
            // Senha incorreta
            $erro = 'Erro de login: Senha incorreta';
        }
    } else {
        // Usuário não encontrado
        $erro = 'Erro de login: Usuário não encontrado';
    }
}

// Exibição de erro genérico
if (isset($erro)) {
    echo "<div class='message'>
        <p>{$erro}</p>
        </div><br>";
    echo "<a href='entrarcliente.php'>Voltar</a>";
}

