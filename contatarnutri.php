<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';

$sql = "SELECT * FROM Nutricionista";
if (isset($_GET['especialidade']) && !empty($_GET['especialidade'])) {
    $especialidade = $_GET['especialidade'];
    $sql .= " WHERE fk_Especialidade_id_especialidade = $especialidade";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha o Nutricionista - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <script src="/Projeto/js/botaoperfil.js"></script>
    <script src="/Projeto/js/menususpenso.js"></script>
    <link href="/Projeto/css/contatarnutri.css" rel="stylesheet">  
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-left text-blue-600 logo"><a href="/Projeto/tela.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <button id="notificationDropdown" onclick="noti()" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
            <i class="fas fa-bell fa-lg"></i>
        </button>
        <div class="relative">
            <button id="profileDropdown" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
                <i class="fas fa-user-circle fa-lg"></i> <?php echo $_SESSION['nome']; ?>
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

<main class="flex-grow flex items-center justify-center">
    <section class="my-1 p-10">
        <div class="max-w-lg mx-auto nutricionista-box">
        <label for="especialidade">Especialidade:</label>
<select name="especialidade" id="especialidade" onchange="filterNutricionistas()">
    <option value="">Todas as especialidades</option>
    <?php
    $sqlEspecialidades = "SELECT * FROM Especialidade";
    $resultEspecialidades = mysqli_query($conn, $sqlEspecialidades);
    while ($rowEspecialidade = mysqli_fetch_assoc($resultEspecialidades)) {
        echo '<option value="' . $rowEspecialidade['id_especialidade'] . '">' . $rowEspecialidade['nome_especialidade'] . '</option>';
    }
    ?>
</select>


            <h2>Escolha o Nutricionista que você quer ser atendido</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" onkeyup="filterNutricionistas()" placeholder="Pesquisar nutricionista...">
            </div>
            <ul class="nutricionista-list" id="nutricionistaList">
                <?php
                    include '/xampp/htdocs/Projeto/bd/connection.php';

                    // Query para buscar todos os nutricionistas
                    $sql = "SELECT * FROM nutricionista";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Loop através dos resultados e exibir como itens da lista
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li class="nutricionista-item" onclick="showNutricionistaDetails(this)">'.htmlspecialchars($row['nome']).'</li>';
                            // Div oculta de detalhes do nutricionista
                            echo '<div class="nutricionista-details" style="display:none;">';
                            // Verifica se a chave 'formacao' está definida antes de acessá-la
                            if(isset($row['formacao'])) {
                                echo '<p><strong>Formação:</strong> ' . htmlspecialchars($row['formacao']) . '</p>';
                            } else {
                                echo '<p><strong>Formação:</strong> Não especificada</p>';
                            }
                            
                            // Verifica se a chave 'email' está definida antes de acessá-la
                            if(isset($row['email'])) {
                                echo '<p><strong>Email:</strong> ' . htmlspecialchars($row['email']) . '</p>';
                            } else {
                                echo '<p><strong>Email:</strong> Não especificado</p>';
                            }
                            // Verifica se a chave 'telefone' está definida antes de acessá-la
                            if(isset($row['telefone'])) {
                                echo '<p><strong>Telefone:</strong> ' . htmlspecialchars($row['telefone']) . '</p>';
                            } else {
                                echo '<p><strong>Telefone:</strong> Não especificado</p>';
                            }
                            // Adicionando botão Avançar com o nome do nutricionista na URL
                            echo '<div class="btn-avancar"><a href="avancarnutri.php?nutricionista='.urlencode($row['nome']).'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Avançar</a></div>';
                            // Adicione outros detalhes aqui, conforme necessário
                            echo '</div>';
                        }
                    } else {
                        echo '<li>Nenhum nutricionista encontrado</li>';
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
    function filterNutricionistas() {
        var input, filter, ul, li, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById('nutricionistaList');
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

    function showNutricionistaDetails(element) {
        // Seleciona a div de detalhes do nutricionista correspondente ao elemento clicado
        var detailsDiv = element.nextElementSibling;
        // Alterna a visibilidade da div de detalhes
        if (detailsDiv.style.display === 'none') {
            detailsDiv.style.display = 'block';
        } else {
            detailsDiv.style.display = 'none';
        }
    }
    function filterNutricionistas() {
    var selectEspecialidade = document.getElementById('especialidade');
    var especialidadeSelecionada = selectEspecialidade.value;

    // Armazena a especialidade selecionada no localStorage
    localStorage.setItem('especialidadeSelecionada', especialidadeSelecionada);

    var nutricionistas = document.getElementsByClassName('nutricionista-item');
    for (var i = 0; i < nutricionistas.length; i++) {
        var nutricionista = nutricionistas[i];
        var especialidadeNutricionista = nutricionista.getAttribute('data-especialidade');
        if (especialidadeSelecionada === '' || especialidadeSelecionada === especialidadeNutricionista) {
            nutricionista.style.display = 'block';
        } else {
            nutricionista.style.display = 'none';
        }
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var especialidadeSelecionada = localStorage.getItem('especialidadeSelecionada');
    if (especialidadeSelecionada) {
        var selectEspecialidade = document.getElementById('especialidade');
        selectEspecialidade.value = especialidadeSelecionada;
    }
});



    function noti(){
    window.location.href = 'notificacoes.php';
}
</script>
<script src="/Projeto/js/botaoperfil.js"></script>
<script src="/Projeto/js/menususpenso.js"></script>
</body>
</html>
