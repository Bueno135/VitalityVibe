<?php
require_once __DIR__ . '/bd/connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avançar - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="css/avancarnutri.css" rel="stylesheet"> 
    <link href="css/padrao.css" rel="stylesheet">
    <script src="js/botaoperfil.js"></script>
    <link rel="icon" href="/imagens/logo.jpeg" type="image/x-icon"></head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-center text-blue-600 logo"><a href="index.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <a href="#" class="text-gray-600 hover:text-blue-600 mr-4" onclick="toggleProfileInfo()">
            <i class="fas fa-user-circle fa-lg"></i> <?php echo $_SESSION['nome']; ?>
        </a>
    </div>
</header>

<!-- Elemento do perfil -->
<div id="profileInfo" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded shadow-lg">
        <p>Nome: <?php echo $_SESSION['nome']; ?></p>
        <p>Email: <?php echo $_SESSION['email']; ?></p>
        <button id="openProfileInfo" onclick="deslogar()" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">Deslogar</button>
        <button id="editarperfil" onclick="editarperfil()" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">Editar perfil</button>
    </div>
</div>

<div class="h-16"></div>

<main class="flex-grow">
    <section class="my-1 p-10">
        <div class="max-w-lg mx-auto nutricionista-box">
            <h2>Avançar - Escolha o Tópico da Conversa</h2>
            <?php
                // Verificar se foi passado o nome do nutricionista na URL
                if (isset($_GET['nutricionista'])) {
                    $nutricionista = $_GET['nutricionista'];
                    echo '<h3>Escolha sobre o que vocês querem conversar com '.$nutricionista.'</h3>';
                } else {
                    echo '<p>Nutricionista não especificado.</p>';
                }
            ?>
            <div class="opcoes-conversa">
                <form action="#" method="post">
                    <?php
                        // Exibir campo oculto para enviar o nome do nutricionista
                        if (isset($nutricionista)) {
                            echo '<input type="hidden" name="nutricionista" value="'.$nutricionista.'">';
                        }
                    ?>
                    <label>
                        <input type="radio" name="opcao_conversa" value="plano_alimentar" checked>
                        Sobre o seu plano alimentar
                    </label>
                    <label>
                        <input type="radio" name="opcao_conversa" value="perda_peso">
                        Sobre perda de peso
                    </label>
                    <label>
                        <input type="radio" name="opcao_conversa" value="ganho_peso">
                        Sobre ganho de peso
                    </label>
                    <label>
                        <input type="radio" name="opcao_conversa" value="outro">
                        Outro
                    </label>
                    <textarea name="outro_opcao" rows="4" placeholder="Digite sua mensagem aqui..."></textarea>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </section>
</main>

<footer class="bg-gray-800 text-white text-center md:text-left">
    <div class="footer-info">
        <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
    </div>
</footer>

</body>
</html>
