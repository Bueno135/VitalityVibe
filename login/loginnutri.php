<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $result = mysqli_query($conn, "SELECT * FROM nutricionista WHERE email='$email' AND senha='$senha'");

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $row['nome'];
        echo'login bem sucedido';
        header('Location: /Projeto/tela.php');
        exit();
    } else {
        echo "<div class='message'>
        <p>Email ou senha incorretas</p>
        </div> <BR>";
        echo "<a href='entrarnutri.php'>Voltar</a>";
    }
}
?>
