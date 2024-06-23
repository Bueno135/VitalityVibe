<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
session_start();

// Verificar se o cliente está logado
if (!isset($_SESSION['id'])) {
    echo "<p>Cliente não conectado. <a href='logincliente.php'>Login</a></p>";
    exit();
}

$clienteID = $_SESSION['id'];

// Consulta para obter as notificações do cliente com o nome do nutricionista e o motivo
$sql_notificacoes = "SELECT m.*, n.nome AS nome_nutricionista
                     FROM mensagem m
                     INNER JOIN nutricionista n ON m.fk_Nutricionista_id_nutricionista = n.id_nutricionista
                     WHERE fk_Cliente_ID_Cliente = ?
                     ORDER BY m.data_envio DESC"; // Ordenar por data de envio decrescente
$stmt_notificacoes = $conn->prepare($sql_notificacoes);
$stmt_notificacoes->bind_param("i", $clienteID);
$stmt_notificacoes->execute();
$result_notificacoes = $stmt_notificacoes->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <link href="/Projeto/css/notificacoes.css" rel="stylesheet">
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-left text-blue-600 logo"><a href="/Projeto/tela.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <button id="notificationDropdown" onclick="noti()" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
            <i class="fas fa-bell fa-lg text-white"></i>
        </button>
        <div class="relative">
            <button id="profileDropdown" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
                <i class="fas fa-user-circle fa-lg text-white"></i> <span class="text-white"><?php echo $_SESSION['nome']; ?></span>
            </button>
            <div id="profileInfo" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                <p class="block px-4 py-2 text-sm text-gray-700">Nome: <?php echo $_SESSION['nome'] = ucwords($_SESSION['nome']); ?></p>
                <p class="block px-4 py-2 text-sm text-gray-700">Email: <?php echo $_SESSION['email']; ?></p>
                <button id="openProfileInfo" onclick="deslogar()" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">Deslogar</button>
                <button id="editarperfil" onclick="editarperfil()" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">Editar perfil</button>
            </div>
        </div>
    </div>
</header>

<div class="h-16"></div>

<main class="flex-grow">
    <section class="my-1 p-10">
        <div class="max-w-lg mx-auto nutricionista-box">
            <h2 class="text-xl font-bold mb-4">Notificações</h2>
            <div class="notificacoes">
                <?php
                if ($result_notificacoes->num_rows > 0) {
                    echo "<ul>";
                    while($row_notificacao = $result_notificacoes->fetch_assoc()) {
                        $mensagem_notificacao = $row_notificacao['mensagem'];
                        $nome_nutricionista = $row_notificacao['nome_nutricionista'];
                        $motivo = $row_notificacao['outro_opcao']; // Adiciona o motivo
                        echo "<li><strong>$nome_nutricionista:</strong> $mensagem_notificacao - Motivo: $motivo</li>"; // Exibe o motivo
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Nenhuma notificação encontrada.</p>";
                }
                ?>
            </div>
        </div>
    </section>
</main>

<footer class="bg-gray-200 text-center py-4 mt-auto footer-info">
    <p>&copy; 2023 VitalityVibe. Todos os direitos reservados.</p>
</footer>
<script>

function noti(){
    window.location.href = 'notificacoes.php';
}
</script>
<script src="/Projeto/js/botaoperfil.js"></script>
<script src="/Projeto/js/menususpenso.js"></script>
</body>
</html>
