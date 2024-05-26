<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
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
    <link href="/Projeto/css/avancarnutri.css" rel="stylesheet"> 
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <script src="/Projeto/js/botaoperfil.js"></script>
    <script src="/Projeto/js/menususpenso.js"></script>
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    <script>
        function toggleTextarea() {
            var dropdown = document.getElementById('opcaoConversa');
            var textarea = document.getElementById('outroOpcao');
            if (dropdown.value) {
                textarea.style.display = 'block';
            } else {
                textarea.style.display = 'none';
            }
        }
    </script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-center text-blue-600 logo"><a href="tela.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <div class="relative">
            <button id="profileDropdown" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
                <i class="fas fa-user-circle fa-lg"></i> <?php echo $_SESSION['nome']; ?>
            </button>
            <div id="profileInfo" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                <p class="block px-4 py-2 text-sm text-gray-700">Nome: <?php echo $_SESSION['nome'] = ucwords($_SESSION['nome']);; ?></p>
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
            <h2 class="text-xl font-bold mb-4">Avançar - Escolha o Tópico da Conversa</h2>
            <?php
                // Verificar se foi passado o nome do nutricionista na URL
                if (isset($_GET['nutricionista']) && !empty($_GET['nutricionista'])) {
                    $nutricionista = htmlspecialchars($_GET['nutricionista']);
                    echo '<h3 class="text-lg mb-4">Escolha sobre o que você quere conversar com '.$nutricionista.'</h3>';
                } else {
                    echo '<p class="text-red-500">Nutricionista não especificado.</p>';
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
                    <div class="mb-4">
                        <label for="opcaoConversa" class="block mb-2">Escolha um tópico:</label>
                        <select id="opcaoConversa" name="opcao_conversa" class="w-full p-2 border rounded" onchange="toggleTextarea()">
                            <option value="">Selecione um tópico</option>
                            <option value="plano_alimentar">Sobre o seu plano alimentar</option>
                            <option value="perda_peso">Sobre perda de peso</option>
                            <option value="ganho_peso">Sobre ganho de peso</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    <textarea id="outroOpcao" name="outro_opcao" rows="4" placeholder="Digite sua mensagem aqui..." style="display:none;" class="w-full p-2 border rounded"></textarea>
                    <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded">Enviar</button>
                </form>
            </div>
        </div>
    </section>
</main>

<footer class="bg-gray-800 text-white text-center md:text-left">
    <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 ">
        <div>
            <h5 class="uppercase mb-2 font-bold">Links Rápidos</h5>
            <ul>
                <li><a href="#sobre" class="hover:text-blue-400">Sobre</a></li>
                <li><a href="#features" class="hover:text-blue-400">Recursos</a></li>
                <li><a href="#contato" class="hover:text-blue-400">Contato</a></li>
                <li><a href="#login" class="hover:text-blue-400">Login</a></li>
                <li><a href="/Projeto/cadastro/cadastrocliente.php" class="hover:text-blue-400">Cadastre-se</a></li>
            </ul>
        </div>

        <div>
            <h5 class="uppercase mb-2 font-bold">Legal</h5>
            <ul>
                <li><a href="#termos-de-uso" class="hover:text-blue-400">Termos de Uso</a></li>
                <li><a href="#privacidade" class="hover:text-blue-400">Política de Privacidade</a></li>
            </ul>
        </div>

        <div>
            <h5 class="uppercase mb-2 font-bold">Contato</h5>
            <ul>
                <li><a href="mailto:info@clevereats.com" class="hover:text-blue-400">info@vitalityvibe.com</a></li>
                <li><a href="tel:+123456789" class="hover:text-blue-400">+1 234 567 89</a></li>
            </ul>
        </div>

        <div>
            <h5 class="uppercase mb-2 font-bold">Mais</h5>
            <ul>
                <li><a href="#dicas-saude" class="hover:text-blue-400">Dicas de Saúde</a></li>
                <li><a href="#receitas-saudaveis" class="hover:text-blue-400">Receitas Saudáveis</a></li>
                <li><a href="#parceiros" class="hover:text-blue-400">Parceiros de Saúde</a></li>
                <li><a href="#faq" class="hover:text-blue-400">Perguntas Frequentes</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-info">
        <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
    </div>
</footer>

</body>
</html>

