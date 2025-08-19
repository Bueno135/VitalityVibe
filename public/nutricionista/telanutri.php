<?php
require_once __DIR__ . '/bd/connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalityVibe - Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="css/telanutri.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <div class="max-w-lg mx-auto bg-white p-10 rounded shadow">
                
                <div id="loginForm">
                    <h2 class="text-3xl font-bold text-center mb-6">Bem-vindo ao VitalityVibe</h2>
                    <!-- Conteúdo da página principal -->
                    <div class="image-container">
                        <a href="#" class="receitas-semana" onclick="showAlert()">
                            <img src="/imagens/Receita da seman.jpg" alt="Receitas da Semana">
                            <p class="font-semibold">Receitas da Semana</p>
                        </a>
                        <a href="/atendimento/" class="atendimento">
                            <img src="/imagens/atendimento.jpg" alt="Atendimento Nutricionista">
                            <p class="font-semibold">Atendimentos</p>
                        </a>
                        <a href="/dietas/criaroueditar.php" class="criar-dieta">
                            <img src="/imagens/check.jpg" alt="Criar Dieta">
                            <p class="font-semibold">Criar e visualizar Dietas</p>
                        </a>
                    </div>
                </div>
                
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white text-center md:text-left">
        <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 footer-info">
            <div>
                <h5 class="uppercase mb-2 font-bold">Links Rápidos</h5>
                <ul>
                    <li><a href="#sobre" class="hover:text-blue-400">Sobre</a></li>
                    <li><a href="#features" class="hover:text-blue-400">Recursos</a></li>
                    <li><a href="#contato" class="hover:text-blue-400">Contato</a></li>
                    <li><a href="#login" class="hover:text-blue-400">Login</a></li>
                    <li><a href="cadastro/cadastrocliente.php" class="hover:text-blue-400">Cadastre-se</a></li>
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

        <div class="text-center p-4 bg-gray-700 mt-4 footer-info">
            <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        function showAlert() {
            Swal.fire({
                position: "top",
                icon: "info",
                title: "Página em manutenção",
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
    
</body>
</html>
