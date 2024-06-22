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

// Adiciona um var_dump para verificar os dados recebidos pelo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);

    // Captura e valida os dados
    $nomeDieta = $_POST["nome_dieta"] ?? '';
    $nomeAlimento = $_POST["nomeAlimento"] ?? '';
    $proteinasAlimento = $_POST["proteinasAlimento"] ?? 0;
    $carboidratosAlimento = $_POST["carboidratosAlimento"] ?? 0;
    $caloriasAlimento = $_POST["caloriasAlimento"] ?? 0;
    $quantidadeAlimento = $_POST["quantidadeAlimento"] ?? 0;
    $horarioAlimento = $_POST["horarioAlimento"] ?? '00:00:00';
    $refeicao = $_POST["refeicao"] ?? '';

    // Insere os dados no banco de dados
    $sql = "INSERT INTO PlanoAlimentar (nome_dieta, horario, descricao, refeicao) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nomeDieta, $horarioAlimento, $nomeAlimento, $refeicao);

    if($stmt->execute()){
        $planoID = $stmt->insert_id;

        $sqlIngrediente = "INSERT INTO PlanoAlimentarIngrediente (fk_plano_alimentar_id, nome_ingrediente, proteinas, carboidratos, calorias, quantidade, refeicao) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtIngrediente = $conn->prepare($sqlIngrediente);
        $stmtIngrediente->bind_param("isdddis", $planoID, $nomeAlimento, $proteinasAlimento, $carboidratosAlimento, $caloriasAlimento, $quantidadeAlimento, $refeicao);

        if($stmtIngrediente->execute()){
            echo "Plano alimentar e ingredientes inseridos com sucesso.";
        } else {
            echo "Erro ao inserir ingredientes: " . $stmtIngrediente->error;
        }

        $stmtIngrediente->close();
    } else {
        echo "Erro ao inserir plano alimentar: " . $stmt->error;
    }

    $stmt->close();
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <form class="form-adicionar" id="formAdicionar" method="POST" action="">
                <!-- Adicione um input hidden para enviar o ID do cliente -->
                <input type="hidden" name="clienteID" value="<?php echo $clienteID; ?>">
                <div class="form-group">
                    <label for="nomePlano" class="block text-gray-700 font-bold mb-2">Nome do plano alimentar:</label>
                    <input type="text" id="nome_dieta" name="nome_dieta" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
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
                    <label for="horarioAlimento" class="block text-gray-700 font-bold mb-2">Horário:</label>
                    <input type="time" id="horarioAlimento" name="horarioAlimento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="form-group">
                    <label for="refeicao" class="block text-gray-700 font-bold mb-2">Refeição:</label>
                    <select id="refeicao" name="refeicao" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="Café da Manhã">Café da Manhã</option>
                        <option value="Almoço">Almoço</option>
                        <option value="Café da Tarde">Café da Tarde</option>
                        <option value="Jantar">Jantar</option>
                    </select>
                </div>
                <!-- Adicione mais campos conforme necessário -->
                <button type="button" id="btnAdicionar" class="btn-adicionar bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Adicionar Alimento</button>
                <hr>
            <h3 class="text-xl font-bold mt-4">Dieta do Cliente</h3>
            <ul id="alimentolist" class="alimento-list">
                <!-- Lista de alimentos adicionados à dieta -->
            </ul>
                <button type="submit" id="btnSalvar" class="btn-salvar bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Salvar Dieta</button>
            </form>
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
let alimentos = [];
const alimentoList = document.querySelector('.alimento-list');

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btnAdicionar').addEventListener('click', function() {
    // Coleta os valores dos campos do formulário
    const nomeAlimento = document.getElementById('nomeAlimento').value;
    const proteinasAlimento = document.getElementById('proteinasAlimento').value;
    const carboidratosAlimento = document.getElementById('carboidratosAlimento').value;
    const caloriasAlimento = document.getElementById('caloriasAlimento').value;
    const quantidadeAlimento = document.getElementById('quantidadeAlimento').value;
    const refeicao = document.getElementById('refeicao').value; // Nova linha para obter o valor da refeição

    // Cria um objeto representando o alimento
    const alimento = {
        nome: nomeAlimento,
        proteinas: proteinasAlimento,
        carboidratos: carboidratosAlimento,
        calorias: caloriasAlimento,
        quantidade: quantidadeAlimento,
        refeicao: refeicao // Alterado para incluir a refeição
    };

    // Adiciona o alimento à lista de alimentos
    alimentos.push(alimento);

    // Atualiza a lista de alimentos na interface
    renderAlimentos();
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
                <span>${alimento.nome} - ${alimento.quantidade}g/ml - ${alimento.refeicao}</span>
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
</script>
<script src="/Projeto/js/botaoperfil.js"></script>
<script src="/Projeto/js/menususpenso.js"></script>
</body>
</html>


