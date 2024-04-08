<?php
include("/xampp/htdocs/Projeto/bd/connection.php");

// CPF a ser verificado
$cpf = 'cpf'; // Você deve obter o CPF de alguma forma, como por meio de um formulário

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

// Fecha a conexão
$conn->close();
?>