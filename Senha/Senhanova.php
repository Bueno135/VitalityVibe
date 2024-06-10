<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $novaSenha = mysqli_real_escape_string($conn, $_POST['nova_senha']);
    $confirmSenha = mysqli_real_escape_string($conn, $_POST['confirm_senha']);

    // Verifica se a nova senha e a confirmação coincidem
    if ($novaSenha !== $confirmSenha) {
        echo "<div class='message'>
        <p>A nova senha e a confirmação não coincidem.</p>
        </div> <BR>";
        echo "<a href='Senhanova.php'>Voltar</a>";
        exit(); // Encerra o script
    }

    // Hashear a nova senha antes de salvar
    $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

    // Verificar se o email e o CPF correspondem na tabela cliente
    $queryCliente = "SELECT * FROM cliente WHERE email='$email' AND cpf='$cpf'";
    $resultCliente = mysqli_query($conn, $queryCliente);

    if (mysqli_num_rows($resultCliente) == 1) {
        // Atualizar a senha na tabela cliente
        $updateQueryCliente = "UPDATE cliente SET senha='$hashedSenha' WHERE email='$email'";
        if (mysqli_query($conn, $updateQueryCliente)) {
            echo 'Senha alterada com sucesso para o cliente';
            header('Location: /Projeto/login/entrar.php');
            exit();
        } else {
            echo "<div class='message'>
            <p>Ocorreu um erro ao alterar a senha do cliente. Tente novamente.</p>
            </div> <BR>";
            echo "<a href='Senhanova.php'>Voltar</a>";
        }
    } else {
        // Verificar se o email e o CPF correspondem na tabela nutricionista
        $queryNutricionista = "SELECT * FROM nutricionista WHERE email='$email' AND cpf='$cpf'";
        $resultNutricionista = mysqli_query($conn, $queryNutricionista);

        if (mysqli_num_rows($resultNutricionista) == 1) {
            // Atualizar a senha na tabela nutricionista
            $updateQueryNutricionista = "UPDATE nutricionista SET senha='$hashedSenha' WHERE email='$email'";
            if (mysqli_query($conn, $updateQueryNutricionista)) {
                echo 'Senha alterada com sucesso para o nutricionista';
                header('Location: /Projeto/login/entrar.php');
                exit();
            } else {
                echo "<div class='message'>
                <p>Ocorreu um erro ao alterar a senha do nutricionista. Tente novamente.</p>
                </div> <BR>";
                echo "<a href='Senhanova.php'>Voltar</a>";
            }
        } else {
            echo "<div class='message'>
            <p>Email ou CPF incorretos.</p>
            </div> <BR>";
            echo "<a href='Senhanova.php'>Voltar</a>";
        }
    }
}
?>
