<?php
include("/xampp/htdocs/Projeto/bd/connection.php");

// Verifica se o CPF foi enviado via POST
if(isset($_POST['cpf'])) {
    // Obtém o CPF do formulário
    $cpf = $_POST['cpf'];

    // Consulta SQL para verificar se o CPF já existe
    $sql = "SELECT COUNT(*) AS total FROM cliente WHERE cpf = '$cpf'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["total"] > 0) {
            echo "CPF já existe no banco de dados";
        } else {
            echo "CPF ainda não existe no banco de dados";
        }
    } else {
        echo "Erro ao executar a consulta: " . $conn->error;
    }
} else {
    echo "CPF não foi enviado via POST";
}

// Fecha a conexão
$conn->close();
?>
