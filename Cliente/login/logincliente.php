<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
<<<<<<< HEAD
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);

    // Adiciona um echo para verificar se os dados estão sendo recebidos
    // echo "Email: $email, Senha: $senha";
    $stmt = $conn->prepare("SELECT * FROM cliente WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $quantidade = $result->num_rows;

    if ($quantidade == 1) {
        $cliente = $result->fetch_assoc();

        // Verifica a senha usando password_verify
        if (password_verify($senha, $cliente['senha'])) {

            if(!isset($_SESSION)){
                session_start();
            }        
            // Senha correta, faça o login
            $_SESSION['id'] = $cliente['ID_Cliente']; // Defina a ID do cliente na sessão
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $cliente['nome']; // Se 'nome' é o campo correto para o nome do cliente

=======
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $result = mysqli_query($conn, "SELECT * FROM cliente WHERE email='$email'");

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        // Verifica a senha usando password_verify
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta, faça o login
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $usuario['nome']; // Se 'nome' é o campo correto para o nome do cliente
            echo 'Login bem sucedido';
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
            header('Location: /Projeto/tela.php');
            exit();
        } else {
            // Senha incorreta
<<<<<<< HEAD
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
    echo "<a href='entrarcliente.php'>Voltar</a>";
=======
            echo "<div class='message'>
            <p>Senha incorreta.</p>
            </div> <BR>";
            echo "<a href='entrarcliente.php'>Voltar</a>";
        }
    } else {
        // Usuário não encontrado
        echo "<div class='message'>
        <p>Usuário não encontrado.</p>
        </div> <BR>";
        echo "<a href='entrarcliente.php'>Voltar</a>";
    }
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
}
?>
