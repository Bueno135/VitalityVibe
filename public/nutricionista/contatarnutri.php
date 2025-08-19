<<<<<<< HEAD
<?php
require_once __DIR__ . '/bd/connection.php';
session_start();
?>
=======
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha o Nutricionista - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="css/padrao.css" rel="stylesheet">
    <script src="js/botaoperfil.js"></script>
    <link href="css/contatarnutri.css" rel="stylesheet">  
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

<main class="flex-grow">
    <section class="my-1 p-10">
        <div class="max-w-lg mx-auto nutricionista-box">
            <h2>Escolha o Nutricionista que você quer ser atendido</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" onkeyup="filterNutricionistas()" placeholder="Pesquisar nutricionista...">
            </div>
            <ul class="nutricionista-list" id="nutricionistaList">
                <?php
                    require_once __DIR__ . '/bd/connection.php';

                    // Query para buscar todos os nutricionistas
                    $sql = "SELECT * FROM nutricionista";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Loop através dos resultados e exibir como itens da lista
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li class="nutricionista-item" onclick="showNutricionistaDetails(this)">'.$row['nome'].'</li>';
                            // Div oculta de detalhes do nutricionista
                            echo '<div class="nutricionista-details">';
                            // Verifica se a chave 'formacao' está definida antes de acessá-la
                            if(isset($row['formacao'])) {
                                echo '<p><strong>Formação:</strong> ' . $row['formacao'] . '</p>';
                            } else {
                                echo '<p><strong>Formação:</strong> Não especificada</p>';
                            }
                            
                            // Verifica se a chave 'email' está definida antes de acessá-la
                            if(isset($row['email'])) {
                                echo '<p><strong>Email:</strong> ' . $row['email'] . '</p>';
                            } else {
                                echo '<p><strong>Email:</strong> Não especificado</p>';
                            }
                            // Verifica se a chave 'telefone' está definida antes de acessá-la
                            if(isset($row['telefone'])) {
                                echo '<p><strong>Telefone:</strong> ' . $row['telefone'] . '</p>';
                            } else {
                                echo '<p><strong>Telefone:</strong> Não especificado</p>';
                            }
                            // Adicionando botão Avançar
                            echo '<div class="btn-avancar"><a href="/nutricionista/avancarnutri.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Avançar</a></div>';
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
    <div class="container mx-auto p-6">
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
</script>

</body>
</html>
