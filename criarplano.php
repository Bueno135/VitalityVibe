<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
session_start();
// Verifica se o ID do cliente está definido e é um número
if (isset($_GET['ID_Cliente'])) {
    $clienteID = $_GET['ID_Cliente'];

    // Consulta o banco de dados para obter o nome do cliente
    $sql = "SELECT nome FROM cliente WHERE ID_Cliente = $clienteID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nomeCliente = $row['nome'];
    } else {
        echo "Cliente não encontrado.";
        exit; // Para a execução do script
    }
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
    <title>Criar Dieta - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link href="/Projeto/css/olhardieta.css" rel="stylesheet">  
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <script src="/Projeto/js/botaoperfil.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/Projeto/js/menususpenso.js"></script>
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-center text-blue-600 logo"><a href="telanutri.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <div class="relative">
            <button id="profileDropdown" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
                <i class="fas fa-user-circle fa-lg"></i> <?php echo $_SESSION['nome']; ?>
            </button>
            <div id="profileInfo" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                <p class="block px-4 py-2 text-sm text-gray-700">Nome: <?php echo $_SESSION['nome'] = ucwords($_SESSION['nome']); ?></p>
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
        <div class="max-w-lg mx-auto dieta-box">
            <h1>Criar Dieta para o Cliente <?php echo $nomeCliente; ?></h1>
            
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
                    <input type="text" id="horarioRefeicao" name="horarioRefeicao" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focusfocus">
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
            <button type="submit" class="btn-salvar bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Salvar Dieta</button>
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
        <h5 class="uppercase mb-2 font-bold">Siga-nos</h5>
        <ul class="flex space-x-4">
            <li><a href="#" class="hover:text-blue-400"><i class="fab fa-facebook fa-2x"></i></a></li>
            <li><a href="#" class="hover:text-blue-400"><i class="fab fa-twitter fa-2x"></i></a></li>
            <li><a href="#" class="hover:text-blue-400"><i class="fab fa-instagram fa-2x"></i></a></li>
        </ul>
    </div>
    </div>
    <div class="text-center mt-4">
        <p>&copy; 2023 VitalityVibe. Todos os direitos reservados.</p>
    </div>
</footer>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const btnAdicionar = document.querySelector('.btn-adicionar');
    const btnSalvar = document.querySelector('.btn-salvar');
    const alimentoList = document.querySelector('.alimento-list');

    // Array para armazenar alimentos adicionados
    let alimentos = [];

    btnAdicionar.addEventListener('click', function() {
        const nomeAlimento = document.getElementById('nomeAlimento').value;
        const proteinasAlimento = document.getElementById('proteinasAlimento').value;
        const carboidratosAlimento = document.getElementById('carboidratosAlimento').value;
        const caloriasAlimento = document.getElementById('caloriasAlimento').value;
        const quantidadeAlimento = document.getElementById('quantidadeAlimento').value;
        const horarioRefeicao = document.getElementById('horarioRefeicao').value;

        // Adiciona o alimento ao array
        alimentos.push({
            nome: nomeAlimento,
            proteinas: proteinasAlimento,
            carboidratos: carboidratosAlimento,
            calorias: caloriasAlimento,
            quantidade: quantidadeAlimento,
            horario: horarioRefeicao
        });

        // Atualiza a lista de alimentos na interface
        renderAlimentos();
    });

    btnSalvar.addEventListener('click', function() {
        // Envia os dados do plano alimentar para o servidor
        fetch('/Projeto/php/salvar_dieta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                clienteID: <?php echo $clienteID; ?>,
                alimentos: alimentos
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Dieta salva com sucesso.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Redireciona para a tela principal ou realiza outra ação desejada
                    window.location.href = 'telanutri.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro ao salvar a dieta. Tente novamente.',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Ocorreu um erro ao salvar a dieta. Tente novamente.',
                confirmButtonText: 'OK'
            });
        });
    });

    function renderAlimentos() {
        // Limpa a lista atual
        alimentoList.innerHTML = '';

        // Renderiza cada alimento na lista
        alimentos.forEach(alimento => {
            const li = document.createElement('li');
            li.classList.add('mb-2', 'flex', 'justify-between');
            li.innerHTML = `
                <span>${alimento.nome} - ${alimento.quantidade}g/ml - ${alimento.horario}</span>
                <button class="btn-remover text-red-500 hover:text-red-700" data-nome="${alimento.nome}">Remover</button>
            `;
            alimentoList.appendChild(li);
        });

        // Adiciona event listeners para os botões de remover
        document.querySelectorAll('.btn-remover').forEach(btn => {
            btn.addEventListener('click', function() {
                const nome = this.getAttribute('data-nome');
                alimentos = alimentos.filter(alimento => alimento.nome !== nome);
                renderAlimentos();
            });
        });
    }
});
</script>

</body>
</html>
