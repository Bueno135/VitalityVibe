
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
        echo"<a href=cadastrocliente.php>Voltar</a>";
        exit();
    
    } else if(mysqli_num_rows($retorno2) > 0) {
        echo"Email Já cadastrado<BR>";
        echo"<a href=cadastrocliente.php>Voltar</a>";
        exit();
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

    $sql = "INSERT INTO grafico (peso) VALUES ('$peso')";

    $sql = "INSERT INTO cliente (Nome, email, senha, cpf, dt_nasc, sexo, CEP, problema_saude, alergias, altura) 
    VALUES ('$nome', '$email', '$senhaHash', '$cpf', '$dt_nasc', '$sexo', '$CEP',  '$problema_saude', 
    '$alergias', '$altura')";
    }
    $resultado = mysqli_query($conn, $sql);
    echo"Usuario cadastrado!!<BR>";
    echo"<a href=confirmarcadastro.php>Avançar</a>";
    $conn->close();
}else{
    echo "não foi por POST";
}
?>
