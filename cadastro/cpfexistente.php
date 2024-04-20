<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cpf'])) {
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);

    $sql = "SELECT COUNT(*) AS total FROM cliente WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["total"] > 0) {
            // CPF já existe
            header('Location: /Projeto/cadastro/cadastrocliente.php?erro=cpfexistente');
            exit;
        } else {
            // CPF não existe, redireciona para o script de processamento principal
            header('Location: /Projeto/cadastro/processacadastro.php');
            exit;
        }
    } else {
        echo "Erro ao executar a consulta: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "CPF não foi enviado via POST";
}
?>
