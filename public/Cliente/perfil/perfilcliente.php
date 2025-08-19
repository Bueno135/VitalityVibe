<?php
require_once __DIR__ . '/../../bd/protect.php';

if (!isset($_SESSION['ID_Cliente'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title></head>
<body>
    <h1>Perfil de <?php echo htmlspecialchars($name); ?></h1>
    <p>Informações do perfil aqui.</p>
</body>
</html>