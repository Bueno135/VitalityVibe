<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar cadastro</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '/xampp/htdocs/Projeto/bd/connection.php';

    if (!$conn) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "SELECT cpf FROM cliente WHERE cpf= '$cpf'";
    $sql2 = "SELECT email FROM cliente WHERE email= '$email'";
    $retorno2 = mysqli_query($conn, $sql2);
    $retorno = mysqli_query($conn, $sql);

    if (mysqli_num_rows($retorno) > 0) {
        echo "CPF Já cadastrado<BR>";
        echo "<a href='/Projeto/Cliente/cadastro/cadastrocliente.php'>Voltar</a>";
        exit();
    } elseif (mysqli_num_rows($retorno2) > 0) {
        echo "Email Já cadastrado<BR>";
        echo "<a href='/Projeto/Cliente/cadastro/cadastrocliente.php'>Voltar</a>";
        exit();
    } else {
        $nome = $_POST['nome'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha
        $dt_nasc = $_POST['dt_nasc'];
        $sexo = $_POST['sexo'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $problema_saude = $_POST['problema_saude'];
        $alergias = $_POST['alergias'];
        $peso = $_POST['peso'];
        $altura = $_POST['altura'];
        $objetivo = $_POST['objetivo'];
        $med_controlado = $_POST['med_controlado'];

        $sql3 = "INSERT INTO cliente (nome, email, senha, cpf, dt_nasc, sexo, cep, telefone, problema_saude, alergias, peso, altura, objetivo, med_controlado) 
        VALUES ('$nome', '$email', '$senha', '$cpf', '$dt_nasc', '$sexo', '$cep', '$telefone', '$problema_saude', '$alergias', '$peso', '$altura', '$objetivo', '$med_controlado')";

        $resultado = mysqli_query($conn, $sql3);

        if ($resultado) {
            header("Location: /Projeto/Cliente/login/entrarcliente");
            exit();
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
    $conn->close();
} else {
    echo "não foi por POST";
}
?>

</body>
</html>

