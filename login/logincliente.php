<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['senha']);

    $result = mysqli_query($conn,"SELECT * FROM cliente WHERE email='$email' AND password='password'") or die("Select Error");
    $row = mysqli_fetch_array($result);

    if(is_array($row) && empty($row)){
        $_SESSION['valid'] = $row['email'];
        $_SESSION['valid'] = $row['nome'];

    } else {
        echo "<div class ='message'>
        <p>Email ou senha incorretas</p>
        </div> <BR>";
        echo "<a href='entrarcliente.php'";
    }

    if(isset($_SESSION['valid'])){
        header('location:index.php');
    }
}
?>
