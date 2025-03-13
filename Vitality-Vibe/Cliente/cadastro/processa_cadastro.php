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
    $cpf = $_POST['cpf'];
    $cpf = mysqli_real_escape_string($conn, $cpf);
    $email = $_POST['email'];
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT cpf FROM cliente WHERE cpf= '$cpf'";
    $sql2 = "SELECT email FROM cliente WHERE email= '$email'";
    $retorno2 = mysqli_query($conn, $sql2);
    $retorno = mysqli_query($conn, $sql);
    if(mysqli_num_rows($retorno) > 0) {
        echo"CPF Já cadastrado<BR>";
        echo"<a href='/Projeto/Cliente/cadastro/cadastrocliente.php'>Voltar</a>";
        exit();
    
    } else if(mysqli_num_rows($retorno2) > 0) {
        echo"Email Já cadastrado<BR>";
        echo"<a href='/Projeto/Cliente/cadastro/cadastrocliente.php'>Voltar</a>";
        exit();
    } else {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $dt_nasc = $_POST['dt_nasc'];
        $sexo = $_POST['sexo'];
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $problema_saude = $_POST['problema_saude'];
        $alergias = $_POST['alergias'];
        $peso = $_POST['peso'];
        $freq_atv_fisica = $_POST['freq_atv_fisica'];
        $altura = $_POST['altura'];
        $med_controlado = $_POST['med_controlado'];

        $sql3 = "INSERT INTO cliente (nome, email, senha, cpf, dt_nasc, sexo, cep, telefone,  problema_saude, freq_atv_fisica, alergias, peso, altura, med_controlado) 
        VALUES ('$nome', '$email', '$senha_hash', '$cpf', '$dt_nasc', '$sexo', '$cep',  '$problema_saude', '$freq_atv_fisica', '$telefone', '$alergias', '$peso','$altura', '$med_controlado')";
        $resultado = mysqli_query($conn, $sql3);

        if($resultado) {
            echo"Usuario cadastrado!!<BR>";
            echo"<a href='/Projeto/Cliente/login/entrarcliente.php'>Avançar</a>";
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
