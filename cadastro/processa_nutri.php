
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '/xampp/htdocs/Projeto/bd/connection.php';
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    $Nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $telefone = $_POST['telefone'];
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $cpf = $_POST['cpf'];
    $dt_nasc = $_POST['dt_nasc'];
    $sexo = $_POST['sexo'];
    $CEP = $_POST['cep'];
    $espec = $_POST['espec'];
    $formacao = $_POST['formacao'];



    $sql = "INSERT INTO cliente (nome, email, senha, cpf, 
    dt_nasc, sexo, cep, formacao) VALUES ('$Nome', '$email', '$senhaHash', '$cpf', '$dt_nasc', 
    '$sexo', '$CEP', '$formacao')";

    $sql = "INSERT INTO especialidade (espec) VALUES ('$espec')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso";
        header("Location: confirmarcadastro.php");
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

    $conn->close();
} else {
    echo "O formulário não foi submetido";
}
?>
