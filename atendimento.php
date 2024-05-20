<<<<<<< HEAD
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

?>
=======
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimento - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
<<<<<<< HEAD
    <link href="/Projeto/css/atendimento.css" rel="stylesheet"> 
    <link href="/Projeto/css/padrao.css" rel="styesheet">
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

        .nutricionista-box {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .nutricionista-box h2 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .opcoes-conversa {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
        }

        .opcoes-conversa h3 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .opcoes-conversa label {
            display: block;
            margin-bottom: 10px;
        }

        .opcoes-conversa p {
            margin-bottom: 10px;
        }

        .opcoes-conversa button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .opcoes-conversa button:hover {
            background-color: #45a049;
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
        <div class="max-w-lg mx-auto nutricionista-box">
            <h2>Atendimento - VitalityVibe</h2>
            <div class="opcoes-conversa">
                <h3>Dúvida recebida:</h3>
                <?php
                if(isset($_POST['duvida'])) {
                    $duvida = $_POST['duvida'];
                    echo "<p><strong>Dúvida:</strong> $duvida</p>";
                    echo "<p>Dúvida recebida com sucesso!</p>";
                } else {
                    echo "<p>Nenhuma dúvida recebida.</p>";
                }
                ?>
                <button type="button" onclick="window.location.href='telanutri.php'">Voltar</button>
            </div>
        </div>
    </section>
</main>

<footer class="bg-gray-800 text-white text-center md:text-left">
<<<<<<< HEAD
    <div class="footer-info ">
=======
    <div class="container mx-auto p-6">
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
        <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
    </div>
</footer>

</body>
</html>
