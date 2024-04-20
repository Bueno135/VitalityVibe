<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '/xampp/htdocs/Projeto/bd/connection.php';

    if (!$conn) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    echo"conectado ao banco<BR>";
    $cpf = $_POST['cpf'];
    $cpf = mysqli_real_escape_string($conn, $cpf);

    $sql = "SELECT cpf FROM nutricionista WHERE cpf= '$cpf'";
    $retorno = mysqli_query($conn, $sql);

    if(mysqli_num_rows($retorno) > 0) {
        echo"CPF Já cadastrado<BR>";
        echo"<a href=cadastronutri.php>Voltar</a>";
        exit();
        
    } else {
        
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['Senha'];
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $cpf = $_POST['cpf'];
    $dt_nasc = $_POST['dt_nasc'];
    $sexo = $_POST['sexo'];
    $CEP = $_POST['cep'];
    $formação = $_POST['formação'];
    $especicilidade = $_POST['especialidade'];

    

    $sql = "INSERT INTO nutricionista (nome, email, senha, cpf, dt_nasc, sexo, CEP,formação, especicilidade ) 
    VALUES ('$nome', '$email', '$senhaHash', '$cpf', '$dt_nasc', '$sexo', '$CEP', '$formação','$especialidade')";
    }
    $resultado = mysqli_query($conn, $sql);
    echo"Usuario cadastrado!!<BR>";
    echo"<a href=confirmarnutri.php>Avançar</a>";
    $conn->close();
}else{
    echo "não foi por POST";
}
?>

