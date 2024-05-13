<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olhar Dieta - VitalityVibe</title>
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

        .subtitulo {
            font-size: 24px; /* Tamanho do subtitulo */
            text-align: center;
            margin-top: 20px;
        }

        .image-container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .image-container a {
            text-align: center;
            position: relative;
        }

        .image-container img {
            height: 300px;
            width: 400px; /* Largura padrão das imagens */
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-bottom: 10px; /* Espaçamento entre a imagem e o texto */
        }

        .image-container img:hover {
            transform: scale(1.05);
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
            <h2 class="text-3xl font-bold text-center mb-6 subtitulo">Minha Dieta</h2>
            <!-- Conteúdo da página olhar dieta -->
            <div class="image-container">
                <a href="#" onclick="showAlert()">
                    <img src="imagens/minha_dieta.jpg" alt="Minha Dieta">
                </a>
            </div>
        </div>
    </section>
</main>

<footer class="bg-gray-800 text-white text-center md:text-left">
    <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 footer-info">
        <!-- Conteúdo do rodapé -->
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
