<<<<<<< HEAD
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $novaSenha = mysqli_real_escape_string($conn, $_POST['nova_senha']);
    $confirmSenha = mysqli_real_escape_string($conn, $_POST['confirm_senha']);

    // Verifica se a nova senha e a confirmação coincidem
    if ($novaSenha !== $confirmSenha) {
        echo "<div class='message'>
        <p>A nova senha e a confirmação não coincidem.</p>
        </div> <BR>";
        echo "<a href='senhanova.php'>Voltar</a>";
        exit(); // Encerra o script
    }

    // Hashear a nova senha antes de salvar

    $result = mysqli_query($conn, "UPDATE cliente SET senha='$senha' WHERE email='$email'");

    if ($result !== false && mysqli_affected_rows($conn) > 0) {
        echo 'Senha alterada com sucesso';

        header('Location: /Projeto/index.php');
        exit();
    } else {
        echo "<div class='message'>
        <p>Ocorreu um erro ao alterar a senha. Tente novamente.</p>
        </div> <BR>";
        echo "<a href='/Projeto/login/entrarcliente.php'>Voltar</a>";
    }
}
?>



=======
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $novaSenha = mysqli_real_escape_string($conn, $_POST['nova_senha']);
    $confirmSenha = mysqli_real_escape_string($conn, $_POST['confirm_senha']);

    // Verifica se a nova senha e a confirmação coincidem
    if ($novaSenha !== $confirmSenha) {
        echo "<div class='message'>
        <p>A nova senha e a confirmação não coincidem.</p>
        </div> <BR>";
        echo "<a href='senhanova.php'>Voltar</a>";
        exit(); // Encerra o script
    }

    // Hashear a nova senha antes de salvar

    $result = mysqli_query($conn, "UPDATE cliente SET senha='$senha' WHERE email='$email'");

    if ($result !== false && mysqli_affected_rows($conn) > 0) {
        echo 'Senha alterada com sucesso';

        header('Location: /Projeto/index.php');
        exit();
    } else {
        echo "<div class='message'>
        <p>Ocorreu um erro ao alterar a senha. Tente novamente.</p>
        </div> <BR>";
        echo "<a href='/Projeto/login/entrarcliente.php'>Voltar</a>";
    }
}
?>



>>>>>>> 647c52fc0ca26000666443febedb459a929b272b
