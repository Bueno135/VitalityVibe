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
    $cpf = $_POST['cpf'] ?? '';
    $cpf = mysqli_real_escape_string($conn, $cpf);
    $email = $_POST['email'] ?? '';
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT cpf FROM nutricionista WHERE cpf= '$cpf'";
    $sql2 = "SELECT email FROM nutricionista WHERE email= '$email'";
    $retorno2 = mysqli_query($conn, $sql2);
    $retorno = mysqli_query($conn, $sql);
    if(mysqli_num_rows($retorno) > 0) {
        echo "CPF Já cadastrado<BR>";
        echo "<a href=cadastronutri.php>Voltar</a>";
        exit();
    
    } else if(mysqli_num_rows($retorno2) > 0) {
        echo "Email Já cadastrado<BR>";
        echo "<a href=cadastronutri.php>Voltar</a>";
        exit();
    } else {
        $nome = $_POST['nome'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $dt_nasc = $_POST['dt_nasc'] ?? '';
        $sexo = $_POST['sexo'] ?? '';
        $cep = $_POST['cep'] ?? '';
        $formacao = $_POST['formacao'] ?? '';
        $especialidade = $_POST['especialidade'] ?? '';
        
        $sql3 = "INSERT INTO formacao (formacao) VALUES ('$formacao')";
        $resultado3 = mysqli_query($conn, $sql3);
        $sql5 = "INSERT INTO especialidade (especialidade) VALUES ('$especialidade')";
        $resultado4 = mysqli_query($conn, $sql5);
        $sql4 = "INSERT INTO nutricionista (nome, email, senha, cpf, dt_nasc, sexo, cep) 
        VALUES ('$nome', '$email', '$senha', '$cpf', '$dt_nasc', '$sexo', '$cep')";
        $resultado2 = mysqli_query($conn, $sql4);

        if($resultado2) {
            echo "Usuário cadastrado!!<BR>";
            echo "<a href=confirmar_nutri.php>Avançar</a>";
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
    $conn->close();
} else {
    echo "Não foi por POST";
}
?>


</body>
</html>



</body>
</html>

