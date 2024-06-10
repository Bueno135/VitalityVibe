<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);

    // Verificar se o email pertence a um cliente
    $stmt_cliente = $conn->prepare("SELECT * FROM cliente WHERE email=?");
    $stmt_cliente->bind_param("s", $email);
    $stmt_cliente->execute();
    $result_cliente = $stmt_cliente->get_result();
    $quantidade_cliente = $result_cliente->num_rows;

    if ($quantidade_cliente == 1) {
        $user = $result_cliente->fetch_assoc();
        // Verifica a senha usando password_verify
        if (password_verify($senha, $user['senha'])) {
            if (!isset($_SESSION)) {
                session_start();
            }
            // Senha correta, faça o login como cliente
            $_SESSION['id'] = $user['ID_Cliente'];
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $user['nome'];
            header('Location: /Projeto/tela.php');
            exit();
        } else {
            // Senha incorreta
            $erro = 'Erro de login: Senha incorreta';
        }
    } else {
        // Verificar se o email pertence a um nutricionista
        $stmt_nutricionista = $conn->prepare("SELECT * FROM nutricionista WHERE email=?");
        $stmt_nutricionista->bind_param("s", $email);
        $stmt_nutricionista->execute();
        $result_nutricionista = $stmt_nutricionista->get_result();
        $quantidade_nutricionista = $result_nutricionista->num_rows;

        if ($quantidade_nutricionista == 1) {
            $user = $result_nutricionista->fetch_assoc();
            // Verifica a senha usando password_verify
            if (password_verify($senha, $user['senha'])) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                // Senha correta, faça o login como nutricionista
                $_SESSION['id'] = $user['id_nutricionista'];
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $user['nome'];
                header('Location: /Projeto/telanutri.php');
                exit();
            } else {
                // Senha incorreta
                $erro = 'Erro de login: Senha incorreta';
            }
        } else {
            // Usuário não encontrado
            $erro = 'Erro de login: Usuário não encontrado';
        }
        $stmt_nutricionista->close();
    }
    $stmt_cliente->close();
    $conn->close();
}

// Exibição de erro genérico
if (isset($erro)) {
    echo "<div>{$erro}</div>";
    echo "<a href=''>Voltar</a>";
}
?>
