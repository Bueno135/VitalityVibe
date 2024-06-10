<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);
    $userType = $conn->real_escape_string($_POST['user_type']);

    // Determinar a tabela correta com base no tipo de usuário
    $table = ($userType === 'cliente') ? 'cliente' : 'nutricionista';
    $idField = ($userType === 'cliente') ? 'ID_Cliente' : 'id_nutricionista';

    $stmt = $conn->prepare("SELECT * FROM $table WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $quantidade = $result->num_rows;

    if ($quantidade == 1) {
        $user = $result->fetch_assoc();

        // Verifica a senha usando password_verify
        if (password_verify($senha, $user['senha'])) {
            if (!isset($_SESSION)) {
                session_start();
            }
            // Senha correta, faça o login
            $_SESSION['id'] = $user[$idField]; // Defina a ID do usuário na sessão
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $user['nome']; // Se 'nome' é o campo correto para o nome do usuário

            // Redirecionar para a página correta após login bem-sucedido
            if ($userType === 'cliente') {
                header('Location: /Projeto/tela.php');
            } else {
                header('Location: /Projeto/telanutri.php');
            }
            exit();
        } else {
            // Senha incorreta
            $erro = 'Erro de login: Senha incorreta';
        }
    } else {
        // Usuário não encontrado
        $erro = 'Erro de login: Usuário não encontrado';
    }

    $stmt->close();
    $conn->close();
}

// Exibição de erro genérico
if (isset($erro)) {
    echo "<div class='message'>
        <p>{$erro}</p>
        </div><br>";
    echo "<a href='entrar.php?user_type=" . htmlspecialchars($userType) . "'>Voltar</a>";
}
?>
