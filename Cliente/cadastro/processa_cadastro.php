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
    $email = $_POST['email'];

    // Verificação de CPF
    $sqlCpf = "SELECT cpf FROM cliente WHERE cpf = ?";
    $stmtCpf = $conn->prepare($sqlCpf);
    if (!$stmtCpf) {
        die("Falha na preparação da consulta de CPF: " . $conn->error);
    }
    $stmtCpf->bind_param("s", $cpf);
    $stmtCpf->execute();
    $stmtCpf->store_result();

    if ($stmtCpf->num_rows > 0) {
        echo "CPF Já cadastrado<BR>";
        echo "<a href='/Projeto/Cliente/cadastro/cadastrocliente.php'>Voltar</a>";
        $stmtCpf->close();
        $conn->close();
        exit();
    }
    $stmtCpf->close();

    // Verificação de Email
    $sqlEmail = "SELECT email FROM cliente WHERE email = ?";
    $stmtEmail = $conn->prepare($sqlEmail);
    if (!$stmtEmail) {
        die("Falha na preparação da consulta de Email: " . $conn->error);
    }
    $stmtEmail->bind_param("s", $email);
    $stmtEmail->execute();
    $stmtEmail->store_result();

    if ($stmtEmail->num_rows > 0) {
        echo "Email Já cadastrado<BR>";
        echo "<a href='/Projeto/Cliente/cadastro/cadastrocliente.php'>Voltar</a>";
        $stmtEmail->close();
        $conn->close();
        exit();
    }
    $stmtEmail->close();

    // Inserção de Dados
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

    $sqlInsert = "INSERT INTO cliente (nome, email, senha, cpf, dt_nasc, sexo, cep, telefone, problema_saude, alergias, peso, altura, objetivo, med_controlado) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    if (!$stmtInsert) {
        die("Falha na preparação da consulta de inserção: " . $conn->error);
    }
    $stmtInsert->bind_param("ssssssssssssss", $nome, $email, $senha, $cpf, $dt_nasc, $sexo, $cep, $telefone, $problema_saude, $alergias, $peso, $altura, $objetivo, $med_controlado);

    if ($stmtInsert->execute()) {
        header("Location: /Projeto/login/entrarcliente.php");
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . $stmtInsert->error;
    }
    $stmtInsert->close();
    $conn->close();
} else {
    echo "Não foi por POST";
}
?>
</body>
</html>
