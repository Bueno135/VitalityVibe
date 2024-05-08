<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalityVibe - Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    <style>
        /* Adicione estilos CSS personalizados aqui */
        .logo {
            font-size: 50px; /* Tamanho do título */
            text-align: center;
            margin-left:12em;
        }

        .footer-info {
            font-size: 14px; /* Tamanho do texto do rodapé */
        }

        .image-container {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }

        .image-container a {
            text-align: center;
            width: 33.33%; /* Para ocupar um terço da largura */
            position: relative;
        }

        .image-container img {
            height: 150px;
            width: 550px; /* Largura padrão das imagens */
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-bottom: 10px; /* Espaçamento entre a imagem e o texto */
        }
        .image-container a {
            text-align: center;
            width: 33.33%; /* Para ocupar um terço da largura */
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-container a:hover::before {
            opacity: 1; /* Tornar o quadrado branco visível ao passar o mouse */
        }

        .image-container img:hover {
            transform: scale(1.05);
        }

        .image-container .receitas-semana img {
            /* Estilos específicos para a imagem de Receitas da Semana */
            border: 2px solid #4CAF50;
            margin-right: 2em;
            width: 550px;
            margin-right: 2em;
        }

        .image-container .contatar-nutri img {
            /* Estilos específicos para a imagem de Contatar Nutricionista */
            border: 2px solid #FF5722;
            margin-left: 1em; 
        }

        .image-container .atendimento img {
            /* Estilos específicos para a imagem de Atendimento */
            border: 2px solid #FF5722;
            margin-left: 1em; 
        }
        .image-container .atendimento p {
            /* Estilos específicos para o texto "Atendimento" */
            margin: 0; /* Remover margens padrão */
            font-size: 18px; /* Tamanho do texto */
            color: #4a5568; /* Cor do texto */
            position: center;
            margin-left: 1em;
        }

        .image-container .criar-dieta img {
            /* Estilos específicos para a imagem de Criar Dieta */
            border: 2px solid #2196F3;
            margin-left: 3em;
        }
        .image-container .criar-dieta p {
            /* Estilos específicos para o texto "Criar Dieta" */
            margin: 0; /* Remover margens padrão */
            font-size: 18px; /* Tamanho do texto */
            color: #4a5568; /* Cor do texto */
            position: center;  
            margin-left: 3em;
        }

        .image-container .receitas-semana p {
            /* Estilos específicos para o texto "Receitas da Semana" */
            margin: 0; /* Remover margens padrão */
            font-size: 18px; /* Tamanho do texto */
            color: #4a5568; /* Cor do texto */
            position: center;
            margin-right: 2em;
        }

        .image-container p {
            margin: 0; /* Remover margens padrão */
            font-size: 18px; /* Tamanho do texto */
            color: #4a5568; /* Cor do texto */

        }
        body {
            background-image: url('imagens/fundo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; /* Garante que o fundo cobrirá toda a altura da página */
            margin: 0; /* Remove margens padrão do corpo */
            padding: 0; /* Remove preenchimento padrão do corpo */
            display: flex;
            flex-direction: column;
        }
    </style>
    
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-center text-blue-600 logo"><a href="index.php">VitalityVibe</a></h1>
    <div>
        <a href="#" class="text-gray-600 hover:text-blue-600"><i class="fas fa-user-circle fa-lg"></i></a>
    </div>
</header>

    <div class="h-16"></div>

    <main class="flex-grow">
        <section class="my-1 p-10">
            <div class="max-w-lg mx-auto bg-white p-10 rounded shadow">
                
                <div id="loginForm">
                    <h2 class="text-3xl font-bold text-center mb-6">Bem-vindo ao VitalityVibe</h2>
                    <!-- Conteúdo da página principal -->
                    <div class="image-container">
                        <a href="#" class="receitas-semana" onclick="showAlert()">
                            <img src="imagens/Receita da seman.jpg" alt="Receitas da Semana">
                            <p class="font-semibold">Receitas da Semana</p>
                        </a>
                        <a href="/atendimento_nutri.php" class="atendimento">
                            <img src="imagens/atendimento.jpg" alt="Atendimento Nutricionista">
                            <p class="font-semibold">Atendimentos</p>
                        </a>
                        <a href="olhardieta.php" class="criar-dieta">
                            <img src="imagens/check.jpg" alt="Criar Dieta">
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

        <div class="text-center p-4 bg-gray-700 mt-4 footer-info">
            <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        function showAlert() {
            alert("Esta página está em manutenção");
        }
    </script>
    
</body>
</html>

