<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $result = mysqli_query($conn, "SELECT * FROM cliente WHERE email='$email'");

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        // Verifica a senha
        if ($senha === $usuario['senha']) {
            // Senha correta, faça o login
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $usuario['nome']; // Se 'nome' é o campo correto para o nome do cliente
            echo 'Login bem sucedido';
            header('Location: /Projeto/index.php');
            exit();
        } else {
            // Senha incorreta
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
}
?>
