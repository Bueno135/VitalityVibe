<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '/xampp/htdocs/Projeto/bd/connection.php';

    if (!$conn) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    $sql = "SELECT cpf FROM Nutricionista WHERE cpf = '$cpf'";
    $sql2 = "SELECT email FROM Nutricionista WHERE email = '$email'";
    $retorno2 = mysqli_query($conn, $sql2);
    $retorno = mysqli_query($conn, $sql);

    if (mysqli_num_rows($retorno) > 0) {
        echo "CPF já cadastrado<BR>";
        echo "<a href=cadastronutri.php>Voltar</a>";
        exit();
    } else if (mysqli_num_rows($retorno2) > 0) {
        echo "Email já cadastrado<BR>";
        echo "<a href=cadastronutri.php>Voltar</a>";
        exit();
    } else {
        $nome = $_POST['nome'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha
        $sexo = $_POST['sexo'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $crn = $_POST['crn'];
        $formacao = $_POST['formacao'];
        $especialidade = $_POST['especialidade'];

        $sql4 = "INSERT INTO Nutricionista (nome, email, senha, cpf, telefone, sexo, cep, crn, formacao, fk_Especialidade_id_especialidade) 
        VALUES ('$nome', '$email', '$senha', '$cpf', '$telefone', '$sexo', '$cep', '$crn', '$formacao', '$especialidade')";
        $resultado2 = mysqli_query($conn, $sql4);

        if ($resultado2) {
            header("Location: /Projeto/login/entrar.php");
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
    $conn->close();
} else {
    echo "Não foi por POST";
}
?>
