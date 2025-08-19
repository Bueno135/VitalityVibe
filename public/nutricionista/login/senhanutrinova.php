<?php
require_once __DIR__ . '/../../bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $novaSenha = mysqli_real_escape_string($conn, $_POST['nova_senha']);
    $confirmSenha = mysqli_real_escape_string($conn, $_POST['confirm_senha']);

    // Verifica se a nova senha e a confirmação coincidem
    if ($novaSenha !== $confirmSenha) {
        echo "<div class='message'>
        <p>A nova senha e a confirmação não coincidem.</p>
        </div> <BR>";
        echo "<a href='entrarnutri.php'>Voltar</a>";
        exit(); // Encerra o script
    }

    // Hashear a nova senha antes de salvar
    $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

    echo "Senha hasheada: $hashedSenha"; // Verificar o hash gerado

    $result = mysqli_query($conn, "UPDATE nutricionista SET senha='$hashedSenha' WHERE email='$email'");

    if ($result !== false && mysqli_affected_rows($conn) > 0) {
        echo 'Senha alterada com sucesso';
        // Redirecionar para entrarnutri.php após a alteração bem-sucedida
        header('Location: /nutricionista/login/entrarnutri.php');
        exit();
    } else {
        echo "<div class='message'>
        <p>Ocorreu um erro ao alterar a senha. Tente novamente.</p>
        </div> <BR>";
        echo "<a href='entrarnutri.php'>Voltar</a>";
    }
}
?>