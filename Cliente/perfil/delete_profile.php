<?php
session_start();
include '/xampp/htdocs/Projeto/bd/connection.php';

if (isset($_SESSION['email']) && isset($_POST['user_type'])) {
    $email = $_SESSION['email'];
    $user_type = $_POST['user_type'];

    if ($user_type == 'cliente') {
        $sql = "DELETE FROM cliente WHERE email = ?";
    } elseif ($user_type == 'nutricionista') {
        $sql = "DELETE FROM nutricionista WHERE email = ?";
    } else {
        echo "Tipo de usuário inválido.";
        exit();
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        // Apagar a sessão e redirecionar para index.php
        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao excluir o perfil.";
    }

    $stmt->close();
} else {
    echo "Usuário não está logado ou tipo de usuário não foi definido.";
}

$conn->close();
?>
