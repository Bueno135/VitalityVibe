<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id_mensagem = $conn->real_escape_string($_POST['id_mensagem']);

    // Query para deletar a mensagem
    $sql = "DELETE FROM mensagem WHERE id_mensagem = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_mensagem);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
