<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha o Cliente - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link href="/Projeto/css/criardieta.css" rel="stylesheet">  
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-center text-blue-600 "><a href="telanutri.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <div class="relative">
            <button id="profileDropdown" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
                <i class="fas fa-user-circle fa-lg"></i> <?php echo $_SESSION['nome']; ?>
            </button>
            <div id="profileInfo" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                <p class="block px-4 py-2 text-sm text-gray-700">Nome: <?php echo $_SESSION['nome'] = ucwords($_SESSION['nome']);; ?></p>
                <p class="block px-4 py-2 text-sm text-gray-700">Email: <?php echo $_SESSION['email']; ?></p>
                <button id="openProfileInfo" onclick="deslogar()" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">Deslogar</button>
                <button id="editarperfil" onclick="editarperfilnutri()" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">Editar perfil</button>
            </div>
        </div>
    </div>
</header>

<div class="h-16"></div>

<main class="flex-grow">
    <section class="my-1 p-10">
        <div class="max-w-lg mx-auto cliente-box">
            <h2>Escolha o Cliente</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" onkeyup="filterClientes()" placeholder="Pesquisar cliente...">
            </div>
            <ul class="cliente-list" id="clienteList">
                <?php
                    // Incluindo o arquivo de conexão com o banco de dados
                    include 'bd/connection.php';

                    // Query para buscar todos os clientes
                    $sql = "SELECT * FROM cliente";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Loop através dos resultados e exibir como itens da lista
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li class="cliente-item" onclick="showClienteDetails(this)" id="'.$row['ID_Cliente'].'">'.$row['nome'].'</li>';
                            // Div oculta de detalhes do cliente
                            echo '<div class="cliente-details" id="'.$row['ID_Cliente'].'_details">';
                            echo '<p><strong>Email:</strong> ' . $row['email'] . '</p>';
                            echo '<p><strong>Telefone:</strong> ' . $row['telefone'] . '</p>';
                            echo '<p><strong>Data de Nascimento:</strong> ' . $row['dt_nasc'] . '</p>';
                            echo '<p><strong>Sexo:</strong> ' . $row['sexo'] . '</p>';
                            echo '<p><strong>Altura:</strong> ' . $row['altura'] . '</p>';
                            echo '<p><strong>Alergias:</strong> ' . $row['alergias'] . '</p>';
                            echo '<p><strong>Problema de Saúde:</strong> ' . $row['problema_saude'] . '</p>';
                            echo '<p><strong>Objetivo:</strong> ' . $row['objetivo'] . '</p>';
                            // Adicionando botão Avançar
                            echo '<div class="btn-avancar"><a href="criarplano.php?ID_Cliente=' . $row['ID_Cliente'] . '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Avançar</a></div>';
                            echo '</div>';

                        }
                    } else {
                        echo '<li>Nenhum cliente encontrado</li>';
                    }
                ?>
            </ul>
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

<script>
    function filterClientes() {
        var input, filter, ul, li, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById('clienteList');
        li = ul.getElementsByTagName('li');

        // Loop através de todos os itens da lista e oculte aqueles que não correspondem à consulta da pesquisa
        for (var i = 0; i < li.length; i++) {
            txtValue = li[i].textContent || li[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = '';
            } else {
                li[i].style.display = 'none';
            }
        }
    }

    function showClienteDetails(element) {
        // Obtém o ID do cliente a partir do elemento clicado
        var clienteId = element.id;
        // Obtém o ID da div de detalhes do cliente
        var detailsId = clienteId + '_details';
        // Seleciona a div de detalhes do cliente
        var detailsDiv = document.getElementById(detailsId);
        // Alterna a visibilidade da div de detalhes
        if (detailsDiv.style.display === 'none') {
            detailsDiv.style.display = 'block';
        } else {
            detailsDiv.style.display = 'none';
        }
    }
   
</script>
<script src="/Projeto/js/botaoperfil.js"></script>
<script src="/Projeto/js/menususpenso.js"></script>
</body>
</html>
