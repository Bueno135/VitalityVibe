<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ID da mensagem foi enviado
    if (isset($_POST['id_mensagem'])) {
        // Obtém o ID da mensagem a ser excluída
        $id_mensagem = $_POST['id_mensagem'];

        // Query para excluir a mensagem do banco de dados
        $sql = "DELETE FROM mensagem WHERE id_mensagem = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_mensagem);

        // Verifica se a exclusão foi bem-sucedida
        if ($stmt->execute()) {
            // Exclusão bem-sucedida
            echo "Mensagem excluída com sucesso!";
        } else {
            // Erro ao excluir a mensagem
            echo "Erro ao excluir a mensagem.";
        }
        $stmt->close();
    } else {
        // ID da mensagem não enviado
        echo "ID da mensagem não especificado.";
    }
} else {
    // Requisição não é do tipo POST
    echo "Acesso inválido.";
}
$conn->close();
?>
