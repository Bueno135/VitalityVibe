
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '/xampp/htdocs/Projeto/bd/connection.php';
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    $Nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['Senha'];
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $cpf = $_POST['cpf'];
    $dt_nasc = $_POST['dt_nasc'];
    $sexo = $_POST['sexo'];
    $CEP = $_POST['cep'];
    $problema_saude = $_POST['problema_saude'];
    $alergias = $_POST['alergias'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];

// telefone	dt_nasc	altura	sexo	senha	freq_atv_fisica	email	cep	obj	cpf	

    $sql = "INSERT INTO grafico (peso) VALUES ('$peso')";

    $sql = "INSERT INTO cliente (name, email, senha, cpf, dt_nasc, sexo, CEP, problema_saude, alergias, altura) 
    VALUES ('$Nome', '$email', '$senhaHash', '$cpf', '$dt_nasc', '$sexo', '$CEP',  '$problema_saude', 
    '$alergias', '$altura')";


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
