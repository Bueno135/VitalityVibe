<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);

    // Adiciona um echo para verificar se os dados estão sendo recebidos
    // echo "Email: $email, Senha: $senha";
    $stmt = $conn->prepare("SELECT * FROM nutricionista WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $quantidade = $result->num_rows;

    if ($quantidade == 1) {
        $nutricionista = $result->fetch_assoc();

        // Verifica a senha usando password_verify
        if (password_verify($senha, $nutricionista['senha'])) {

            if(!isset($_SESSION)){
                session_start();
            }        
            // Senha correta, faça o login
            $_SESSION['id'] = $nutricionista['id_nutricionista']; // Defina a ID do nutricionista na sessão
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $nutricionista['nome']; // Se 'nome' é o campo correto para o nome do cliente

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

    $stmt->close();
    $conn->close();
}

// Exibição de erro genérico
if (isset($erro)) {
    echo "<div class='message'>
        <p>{$erro}</p>
        </div><br>";
    echo "<a href='entrarnutri.php'>Voltar</a>";
}

