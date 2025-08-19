<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar cadastro</title></head>
<body>
<?php
require_once __DIR__ . '/../../includes/csrf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { csrf_validate();
    require_once __DIR__ . '/../../bd/connection.php';

    if (!$conn) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    $cpf = $_POST['cpf'];
    $cpf = mysqli_real_escape_string($conn, $cpf);
    $email = $_POST['email'];
    $email = mysqli_real_escape_string($conn, $email);

    $stmtCpf = $conn->prepare("SELECT cpf FROM cliente WHERE cpf=?");
    $stmtCpf->bind_param("s", $cpf);
    $stmtCpf->execute();
    $resCpf = $stmtCpf->get_result();

    $stmtEmail = $conn->prepare("SELECT email FROM cliente WHERE email=?");
    $stmtEmail->bind_param("s", $email);
    $stmtEmail->execute();
    $resEmail = $stmtEmail->get_result();
    $retorno2 = mysqli_query($conn, $sql2);
    $retorno = mysqli_query($conn, $sql);
    if(mysqli_num_rows($retorno) > 0) {
        echo"CPF Já cadastrado<BR>";
        echo"<a href='Cliente/cadastro/cadastrocliente.php'>Voltar</a>";
        exit();
    
    } else if(mysqli_num_rows($retorno2) > 0) {
        echo"Email Já cadastrado<BR>";
        echo"<a href='Cliente/cadastro/cadastrocliente.php'>Voltar</a>";
        exit();
    } else {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $dt_nasc = $_POST['dt_nasc'];
        $sexo = $_POST['sexo'];
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $problema_saude = $_POST['problema_saude'];
        $alergias = $_POST['alergias'];
        $peso = $_POST['peso'];
        $freq_atv_fisica = $_POST['freq_atv_fisica'];
        $altura = $_POST['altura'];
        $med_controlado = $_POST['med_controlado'];

        $stmtIns = $conn->prepare("INSERT INTO cliente (nome, email, senha, cpf, dt_nasc, sexo, cep, telefone, problema_saude, freq_atv_fisica, alergias, peso, altura, med_controlado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmtIns->bind_param("ssssssssssssss", $nome, $email, $senha_hash, $cpf, $dt_nasc, $sexo, $cep, $telefone, $problema_saude, $freq_atv_fisica, $alergias, $peso, $altura, $med_controlado);
    $resultado = $stmtIns->execute();

        if($resultado) {
            echo"Usuario cadastrado!!<BR>";
            echo"<a href='Cliente/login/entrarcliente.php'>Avançar</a>";
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
    $conn->close();
} else {
    echo "não foi por POST";
}
?>

</body>
</html>
