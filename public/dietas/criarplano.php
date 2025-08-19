<?php
require_once __DIR__ . '/bd/connection.php';
require_once __DIR__ . '/bd/protect.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Dieta - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link href="css/olhardieta.css" rel="stylesheet">  
    <link href="css/padrao.css" rel="stylesheet">
    <script src="js/botaoperfil.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <div class="max-w-lg mx-auto dieta-box">
            <h2>Criar Dieta para o Cliente</h2>
            <!-- Botão para adicionar alimento -->
            <button class="btn-adicionar bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Adicionar Alimento</button>
            <!-- Formulário para adicionar alimento -->
            <form class="form-adicionar" id="formAdicionar">
                <div class="form-group">
                    <label for="nomeAlimento" class="block text-gray-700 font-bold mb-2">Nome do Alimento:</label>
                    <input type="text" id="nomeAlimento" name="nomeAlimento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="form-group">
                    <label for="proteinasAlimento" class="block text-gray-700 font-bold mb-2">Proteínas (g):</label>
                    <input type="number" id="proteinasAlimento" name="proteinasAlimento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="form-group">
                    <label for="carboidratosAlimento" class="block text-gray-700 font-bold mb-2">Carboidratos (g):</label>
                    <input type="number" id="carboidratosAlimento" name="carboidratosAlimento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="form-group">
                    <label for="caloriasAlimento" class="block text-gray-700 font-bold mb-2">Calorias:</label>
                    <input type="number" id="caloriasAlimento" name="caloriasAlimento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="form-group">
                    <label for="quantidadeAlimento" class="block text-gray-700 font-bold mb-2">Quantidade (g/ml):</label>
                    <input type="number" id="quantidadeAlimento" name="quantidadeAlimento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="form-group">
                    <label for="horarioRefeicao" class="block text-gray-700 font-bold mb-2">Horário da Refeição:</label>
                    <select id="horarioRefeicao" name="horarioRefeicao" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="Café da Manhã">Café da Manhã</option>
                        <option value="Lanche da Manhã">Lanche da Manhã</option>
                        <option value="Almoço">Almoço</option>
                        <option value="Lanche da Tarde">Lanche da Tarde</option>
                        <option value="Janta">Janta</option>
                    </select>
                </div>
                <!-- Adicione mais campos conforme necessário -->
                <button type="button" class="btn-adicionar bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Adicionar Alimento</button>
            </form>
            <hr>
            <h3 class="text-xl font-bold mt-4">Dieta do Cliente</h3>
            <ul class="alimento-list">
                <!-- Lista de alimentos adicionados à dieta -->
            </ul>
            <!-- Botão para salvar a dieta -->
            <button class="btn-salvar bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Salvar Dieta</button>
        </div>
    </section>
</main>

<footer class="bg-gray-800 text-white text-center md:text-left">
    <div class="footer-info">
        <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
    </div>
</footer>

<script>
    // Adicione evento de clique ao botão "Adicionar Alimento"
    document.querySelector('.btn-adicionar').addEventListener('click', function() {
        // Exibir o formulário de adição de alimento
        document.querySelector('.form-adicionar').style.display = 'block';
    });

    // Adicionar evento de clique ao botão "Adicionar Alimento" dentro do formulário
    document.querySelector('#formAdicionar .btn-adicionar').addEventListener('click', function() {
        // Obter os valores dos campos de entrada
        var nomeAlimento = document.querySelector('#nomeAlimento').value;
        var proteinasAlimento = document.querySelector('#proteinasAlimento').value;
        var carboidratosAlimento = document.querySelector('#carboidratosAlimento').value;
        var caloriasAlimento = document.querySelector('#caloriasAlimento').value;
        var quantidadeAlimento = document.querySelector('#quantidadeAlimento').value;
        var horarioRefeicao = document.querySelector('#horarioRefeicao').value;

        // Validar se os campos não estão vazios
        if (nomeAlimento && proteinasAlimento && carboidratosAlimento && caloriasAlimento && quantidadeAlimento && horarioRefeicao) {
            // Criar uma string HTML para o novo item de alimento
            var newItemHTML = '<li><strong>' + nomeAlimento + '</strong> - Proteínas: ' + proteinasAlimento + 'g, Carboidratos: ' + carboidratosAlimento + 'g, Calorias: ' + caloriasAlimento + ', Quantidade: ' + quantidadeAlimento + 'g, Horário: ' + horarioRefeicao + '</li>';

            // Adicionar o novo item à lista de alimentos
            document.querySelector('.alimento-list').innerHTML += newItemHTML;

            // Limpar os campos do formulário após adicionar o alimento
            document.querySelector('#nomeAlimento').value = '';
            document.querySelector('#proteinasAlimento').value = '';
            document.querySelector('#carboidratosAlimento').value = '';
            document.querySelector('#caloriasAlimento').value = '';
            document.querySelector('#quantidadeAlimento').value = '';
            document.querySelector('#horarioRefeicao').value = '';
        } else {
            // Exibir uma mensagem de erro se algum campo estiver vazio
            Swal.fire({
            position: "top",
            icon: "error",
            title: "Por favor, preencha todos os campos!",
            showConfirmButton: false,
            timer: 1500
            });
        }

    
    // Adicionar evento de clique ao botão "Salvar Dieta"
    document.querySelector('.btn-salvar').addEventListener('click', function() {
        // Simular salvamento da dieta
        Swal.fire({
            position: "top",
            icon: "sucess",
            title: "Dieta salva com sucesso",
            showConfirmButton: false,
            timer: 1500
            });
    });
});
</script>

</body>
</html>
