<<<<<<< HEAD
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';
?>
=======
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalityVibe - Criar ou Visualizar Dietas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
<<<<<<< HEAD
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <link href="/Projeto/css/criaroueditar.css" rel="stylesheet"> 
    <script src="/Projeto/js/botaoperfil.js"></script> 
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
=======
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
            width: 50%; /* Para ocupar metade da largura */
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-container a:hover::before {
            opacity: 1; /* Tornar o quadrado branco visível ao passar o mouse */
        }

        .image-container img {
            height: 150px;
            width: 550px; /* Largura padrão das imagens */
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-bottom: 10px; /* Espaçamento entre a imagem e o texto */
        }

        .image-container img:hover {
            transform: scale(1.05);
        }

        .image-container .criar-dieta img {
            /* Estilos específicos para a imagem de Criar Dieta */
            border: 2px solid #2196F3;
            margin-right: 2em;
        }
        .image-container .criar-dieta p {
            /* Estilos específicos para o texto "Criar Dieta" */
            margin: 0; /* Remover margens padrão */
            font-size: 18px; /* Tamanho do texto */
            color: #4a5568; /* Cor do texto */
        }

        .image-container .visualizar-dietas img {
            /* Estilos específicos para a imagem de Visualizar Dietas */
            border: 2px solid #FF5722;
            margin-left: 2em;
        }
        .image-container .visualizar-dietas p {
            /* Estilos específicos para o texto "Visualizar Dietas" */
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
    
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-center text-blue-600 logo"><a href="index.php">VitalityVibe</a></h1>
<<<<<<< HEAD
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

=======
    <div>
        <a href="#" class="text-gray-600 hover:text-blue-600"><i class="fas fa-user-circle fa-lg"></i></a>
    </div>
</header>

>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
    <div class="h-16"></div>

    <main class="flex-grow">
        <section class="my-1 p-10">
            <div class="max-w-lg mx-auto bg-white p-10 rounded shadow">
                
                <div id="loginForm">
                    <h2 class="text-3xl font-bold text-center mb-6">Escolha uma opção:</h2>
                    <!-- Conteúdo da página principal -->
                    <div class="image-container">
                        <a href="criardieta.php" class="criar-dieta">
                            <img src="imagens/22.jpg" alt="Criar Dieta">
                            <p class="font-semibold text-center mt-2" style="margin-right: 30px;">Criar Dieta</p>
                        </a>
                        <a href="visualizar_dietas.php" class="visualizar-dietas">
                            <img src="imagens/11.jpg" alt="Visualizar Dietas"> <!-- Substituição da imagem -->
                            <p class="font-semibold text-center mt-2" style="margin-left: 30px;">Visualizar Dietas Criadas</p>
                        </a>
                    </div>
                </div>
                
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white text-center md:text-left">
        <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 footer-info">
            <!-- Conteúdo do rodapé -->
        </div>

<<<<<<< HEAD
        <div class="footer-info">
=======
        <div class="text-center p-4 bg-gray-700 mt-4 footer-info">
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
            <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Seu JavaScript -->
    
</body>
</html>
