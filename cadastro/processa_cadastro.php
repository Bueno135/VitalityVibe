
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if (!$conn) {
    die("Conexão falhou: " . $conn->connect_error);
}
echo"conectado ao banco";
$cpf = $_POST['cpf'];
$cpf = mysqli_real_escape_string($conn, $cpf);

$sql = "SELECT cpf FROM cliente WHERE cpf= '$cpf'";
$retorno = mysqli_query($conn, $sql);

if(mysqli_num_rows($retorno) > 0) {
    echo"CPF Já cadastrado";
} else {
    
$nome = $_POST['Nome'];
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

$sql = "INSERT INTO cliente (Nome, email, senha, cpf, dt_nasc, sexo, CEP, problema_saude, alergias, altura) 
VALUES ('$nome', '$email', '$senhaHash', '$cpf', '$dt_nasc', '$sexo', '$CEP',  '$problema_saude', 
'$alergias', '$altura')";
}
$resultado = mysqli_query($conn, $sql);
echo"Usuario cadastrado!!<BR>";
echo"<a href='confirmarcadastro.php'>AVANÇAR</a>;
$conn->close();
?>
