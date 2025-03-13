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
        echo "<a href='entrarcliente.php'>Voltar</a>";
        exit(); // Encerra o script
    }

    // Hashear a nova senha antes de salvar
    $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

    echo "Senha hasheada: $hashedSenha"; // Verificar o hash gerado

    $result = mysqli_query($conn, "UPDATE cliente SET senha='$hashedSenha' WHERE email='$email'");

    if ($result !== false && mysqli_affected_rows($conn) > 0) {
        // Exibir Sweet Alert
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
        echo "<script>
        Swal.fire({
            title: 'Senha alterada com sucesso!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/Projeto/Cliente/login/entrarcliente.php'; // Redirecionar para login.php após o OK
        });
        </script>";
        exit();
    } else {
        echo "<div class='message'>
        <p>Ocorreu um erro ao alterar a senha. Tente novamente.</p>
        </div> <BR>";
        echo "<a href='senhacliente.php'>Voltar</a>";
    }
}
?>
