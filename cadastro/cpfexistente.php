<?php
include("/xampp/htdocs/Projeto/bd/connection.php");

// Verifica se o CPF foi enviado via POST
if(isset($_POST['cpf'])) {
    // Obtém e limpa o CPF do formulário
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);

    // Consulta SQL preparada para verificar se o CPF já existe
    $sql = "SELECT COUNT(*) AS total FROM cliente WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["total"] > 0) {
            echo "CPF já existe no banco de dados";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {    
            echo "CPF ainda não existe no banco de dados";
            header("Location: processacadastro.php");
        }
    } else {
        echo "Erro ao executar a consulta: " . $conn->error;
    }

    // Fecha o statement
    $stmt->close();
} else {
    echo "CPF não foi enviado via POST";
}

// Fecha a conexão
$conn->close();
?>
