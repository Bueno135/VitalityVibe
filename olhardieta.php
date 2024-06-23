<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
session_start();

// Verifica se o ID do cliente está definido e é um número
if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
    $clienteID = $_SESSION['id'];

    // Consulta o banco de dados para obter as dietas associadas ao cliente
    $sql = "
        SELECT 
            c.id_contrato, 
            n.nome AS nome_nutricionista, 
            p.nome_dieta AS planoalimentar, 
            p.descricao 
        FROM 
            contrato_cliente_nutricionista_planoalimentar c
        JOIN 
            nutricionista n ON c.fk_nutricionista_id_nutricionista = n.id_nutricionista
        JOIN 
            planoalimentar p ON c.fk_PlanoAlimentar_id_plano = p.id_plano
        WHERE 
            c.fk_cliente_id_cliente = $clienteID";
    $result = $conn->query($sql);
} else {
    echo "ID de cliente inválido.";
    exit; // Para a execução do script
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dietas Disponíveis</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <link href="/Projeto/css/olhardieta.css" rel="stylesheet">
    <style>
        .dieta-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .dieta-box ul {
            list-style-type: none;
            padding: 0;
        }

        .dieta-box li {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .dieta-box li:last-child {
            border-bottom: none;
        }

        .dieta-box li strong {
            display: block;
            font-size: 1.2em;
            color: #333;
        }

        .dieta-box li p {
            margin-top: 5px;
            color: #555;
        }

        .footer-info {
            padding: 10px 0;
            background: #333;
            color: white;
        }

        footer ul {
            list-style-type: none;
            padding: 0;
        }

        footer li {
            margin: 8px 0;
        }

        footer a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #fff;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-left text-blue-600 logo"><a href="/Projeto/tela.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <button id="notificationDropdown" onclick="noti()" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
            <i class="fas fa-bell fa-lg text-white"></i>
        </button>
        <div class="relative">
            <button id="profileDropdown" class="text-gray-600 hover:text-white-600 mr-4 focus:outline-none">
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
        <div class="max-w-lg mx-auto dieta-box">
            <?php
            if (isset($result) && $result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    $nomeNutricionista = $row['nome_nutricionista'];
                    $planoalimentar = $row['planoalimentar'];
                    $descricao = $row['descricao'];
                    echo "<li><strong>Nutricionista:</strong> $nomeNutricionista <br> <strong>Dieta:</strong> $planoalimentar <p><strong>Descrição:</strong> $descricao</p></li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nenhuma dieta disponível no momento.</p>";
            }
            ?>
        </div>
    </section>
</main>

<footer class="bg-gray-800 text-white text-center md:text-left">
    <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div>
            <h5 class="uppercase mb-2 font-bold">Links Rápidos</h5>
            <ul>
                <li><a href="#sobre" class="hover:text-blue-400">Sobre</a></li>
                <li><a href="#features" class="hover:text-blue-400">Recursos</a></li>
                <li><a href="#contato" class="hover:text-blue-400">Contato</a></li>
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
<script>
    document.getElementById("profileDropdown").addEventListener("click", function() {
        var dropdown = document.getElementById("profileInfo");
        dropdown.classList.toggle("hidden");
    });
    document.getElementById("profileDropdown").addEventListener("click", function() {
        var dropdown = document.getElementById("profileInfo");
        var notificationDropdown = document.getElementById("notificationInfo");
        dropdown.classList.toggle("hidden");
        notificationDropdown.classList.add("hidden");
    });
    function noti() {
        window.location.href = 'notificacoes.php';
    }
</script>
<script src="/Projeto/js/botaoperfil.js"></script>
<script src="/Projeto/js/menususpenso.js"></script>
</body>
</html>
