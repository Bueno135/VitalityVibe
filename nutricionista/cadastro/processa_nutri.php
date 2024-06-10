<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '/xampp/htdocs/Projeto/bd/connection.php';

    if (!$conn) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    // Usar prepared statements para evitar SQL Injection
    $stmt = $conn->prepare("SELECT cpf FROM Nutricionista WHERE cpf = ?");
    if (!$stmt) {
        die("Falha na preparação da consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "CPF já cadastrado<BR>";
        echo "<a href=cadastronutri.php>Voltar</a>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    $stmt = $conn->prepare("SELECT email FROM Nutricionista WHERE email = ?");
    if (!$stmt) {
        die("Falha na preparação da consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email já cadastrado<BR>";
        echo "<a href=cadastronutri.php>Voltar</a>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    $nome = $_POST['nome'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $crn = $_POST['crn'];
    $formacao = $_POST['formacao'];
    $especialidade = $_POST['especialidade'];

    $stmt = $conn->prepare("INSERT INTO Nutricionista (nome, email, senha, cpf, telefone, sexo, cep, crn, formacao, fk_Especialidade_id_especialidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Falha na preparação da consulta: " . $conn->error);
    }
    $stmt->bind_param("sssssssssi", $nome, $email, $senha, $cpf, $telefone, $sexo, $cep, $crn, $formacao, $especialidade);

    if ($stmt->execute()) {
        header("Location: /Projeto/login/entrar.php");
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Não foi por POST";
}
?>
