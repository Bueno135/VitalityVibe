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
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha
        $sexo = $_POST['sexo'] ?? '';
        $telefone = $_POST['telefone']?? '';
        $cep = $_POST['cep'] ?? '';
        $crn = $_POST['crn'] ?? '';
        $formacao = $_POST['formacao'] ?? '';
        $especialidade = $_POST['especialidade'] ?? '';
        $sql5 = "INSERT INTO especialidade (nome_especialidade) VALUES ('$especialidade')";
        $resultado4 = mysqli_query($conn, $sql5);
        $sql4 = "INSERT INTO nutricionista (nome, email, senha, cpf, telefone, sexo, cep, crn, formacao) 
        VALUES ('$nome', '$email', '$senha_hash', '$cpf', '$telefone', '$sexo', '$cep', '$crn', '$formacao')";
        $resultado2 = mysqli_query($conn, $sql4);

        if($resultado2) {
            echo "Usuário cadastrado!!<BR>";
            echo "<a href=/Projeto/nutricionista/login/entrarnutri.php>Avançar</a>";
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
    $conn->close();
} else {
    echo "Não foi por POST";
}
?>
