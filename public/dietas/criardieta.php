<?php
require_once __DIR__ . '/bd/connection.php';
require_once __DIR__ . '/bd/protect.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha o Cliente - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="css/padrao.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link href="css/criardieta.css" rel="stylesheet">  
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
        <div class="max-w-lg mx-auto cliente-box">
            <h2>Escolha o Cliente</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" onkeyup="filterClientes()" placeholder="Pesquisar cliente...">
            </div>
            <ul class="cliente-list" id="clienteList">
                <?php
                    // Incluindo o arquivo de conexão com o banco de dados
                    include __DIR__ . '/../app/bd/connection.php';

                    // Query para buscar todos os clientes
                    $sql = "SELECT * FROM cliente";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Loop através dos resultados e exibir como itens da lista
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li class="cliente-item" onclick="showClienteDetails(this)" id="'.$row['ID_Cliente'].'">'.$row['nome'].'</li>';
                            // Div oculta de detalhes do cliente
                            echo '<div class="cliente-details" id="'.$row['ID_Cliente'].'_details">';
                            echo '<p><strong>Telefone:</strong> ' . $row['telefone'] . '</p>';
                            echo '<p><strong>Data de Nascimento:</strong> ' . $row['dt_nasc'] . '</p>';
                            echo '<p><strong>Altura:</strong> ' . $row['altura'] . '</p>';
                            echo '<p><strong>Frequência de Atividade Física:</strong> ' . $row['freq_atv_fisica'] . '</p>';
                            echo '<p><strong>Email:</strong> ' . $row['email'] . '</p>';
                            echo '<p><strong>Alergias:</strong> ' . $row['alergias'] . '</p>';
                            echo '<p><strong>Problema de Saúde:</strong> ' . $row['problema_saude'] . '</p>';
                            echo '<p><strong>Sexo:</strong> ' . $row['sexo'] . '</p>';
                            echo '<p><strong>Objetivo:</strong> ' . $row['fk_Objetivo_id_obj'] . '</p>';
                            // Adicionando botão Avançar
                            echo '<div class="btn-avancar"><a href="/dietas/criarplano.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Avançar</a></div>';
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

</body>
</html>
