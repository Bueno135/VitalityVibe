<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar cadastro</title>
</head>
<body>
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

// Verifique se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare a consulta SQL
    $stmt = $conn->prepare("UPDATE nutricionista SET nome=?, email=?, cpf=?, dt_nasc=?, sexo=?, cep=?, especialidade=?, formacao=? WHERE id_nutricionista=?");


    // Associe os parâmetros
    $stmt->bind_param("sssssssssi", $nome, $email, $cpf, $dt_nasc, $sexo, $cep, $especialidade, $formacao, $id_nutricionista);

    // Defina os valores das variáveis
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $dt_nasc = $_POST['dt_nasc'];
    $sexo = $_POST['sexo'];
    $cep = $_POST['cep'];
    $especialidade = $_POST['especialidade'];
    $formacao = $_POST['formacao'];
   


    // Execute a consulta
    if ($stmt->execute()) {
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location.href='/Projeto/login/entrarnutri.php';</script>";
    } else {
        echo "Erro ao atualizar o cadastro: " . $conn->error;
    }

    // Feche a declaração e a conexão
    $stmt->close();
    $conn->close();
}

?>
</body>
</html>