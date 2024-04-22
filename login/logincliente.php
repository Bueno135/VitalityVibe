<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $result = mysqli_query($conn, "SELECT * FROM cliente WHERE email='$email'");

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        if ($senha === $usuario['senha']) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $usuario['nome']; 
            echo 'Login bem sucedido';
            header('Location: /Projeto/index.php');
            exit();
        } else {
            echo "<div class='message'>
            <p>Senha incorreta.</p>
            </div> <BR>";
            echo "<a href='entrarcliente.php'>Voltar</a>";
        }
    } else {
        echo "<div class='message'>
        <p>Usuário não encontrado.</p>
        </div> <BR>";
        echo "<a href='entrarcliente.php'>Voltar</a>";
    }
}
?>
