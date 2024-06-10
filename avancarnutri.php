<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o nutricionista está logado
    if (!isset($_SESSION['id'])) {
        echo "<p>Nutricionista não conectado. <a href='entrarnutri.php'>Login</a></p>";
        exit();
    }

    // ID do nutricionista logado
    $nutricionistaID = $_SESSION['id'];

    // Verificar se foi passado o nome do nutricionista na URL
    if (isset($_GET['nutricionista']) && !empty($_GET['nutricionista'])) {
        $nutricionista = htmlspecialchars($_GET['nutricionista']);

        // Consulta para obter o ID do nutricionista
        $sql_nutricionista = "SELECT id_nutricionista FROM Nutricionista WHERE nome = ? LIMIT 1";
        $stmt_nutricionista = $conn->prepare($sql_nutricionista);
        $stmt_nutricionista->bind_param("s", $nutricionista);
        $stmt_nutricionista->execute();
        $result_nutricionista = $stmt_nutricionista->get_result();

        if ($result_nutricionista->num_rows > 0) {
            $row_nutricionista = $result_nutricionista->fetch_assoc();
            $nutricionistaID = $row_nutricionista['id_nutricionista'];
        } else {
            echo "Nutricionista não encontrado.";
            exit;
        }

        $stmt_nutricionista->close();

        // ID do cliente da sessão
        $clienteID = $_SESSION['id'];

        // Preparar os dados para inserção na tabela mensagem
        $opcao_conversa = $_POST['opcao_conversa'];
        $outro_opcao = $_POST['outro_opcao'];
        $mensagem = "Mensagem sobre $opcao_conversa";

        // Inserir os dados na tabela mensagem
        $sql_insert = "INSERT INTO mensagem (mensagem, opcao_conversa, outro_opcao, data_envio, fk_nutricionista_id_nutricionista, fk_Cliente_ID_Cliente) VALUES (?, ?, ?, NOW(), ?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("sssii", $mensagem, $opcao_conversa, $outro_opcao, $nutricionistaID, $clienteID);

        if ($stmt->execute()) {
            echo "<p>Dúvida enviada com sucesso. <a href='/Projeto/tela.php'>Voltar</a></p>";
        } else {
            echo "<p>Erro ao enviar a dúvida: " . $stmt->error . ". <a href='/Projeto/escolhanutri.php?nutricionista=" . $nutricionista . "'>Tentar novamente</a></p>";
        }

        return;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avançar - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="/Projeto/css/avancarnutri.css" rel="stylesheet">
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <script src="/Projeto/js/botaoperfil.js"></script>
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    <script>
        function toggleTextarea() {
            var dropdown = document.getElementById('opcaoConversa');
            var textarea = document.getElementById('outroOpcao');
            if (dropdown.value === "outro") {
                textarea.style.display = 'block';
            } else {
                textarea.style.display = 'none';
            }
        }
    </script>
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

<div class="h-16"></div>

<main class="flex-grow">
    <section class="my-1 p-10">
        <div class="max-w-lg mx-auto nutricionista-box">
            <h2 class="text-xl font-bold mb-4">Avançar - Escolha o Tópico da Conversa</h2>
            <?php
                if (isset($_GET['nutricionista']) && !empty($_GET['nutricionista'])) {
                    $nutricionista = htmlspecialchars($_GET['nutricionista']);
                    echo '<h3 class="text-lg mb-4">Escolha sobre o que você quer conversar com '.$nutricionista.'</h3>';
                } else {
                    echo '<p class="text-red-500">Nutricionista não especificado.</p>';
                }
            ?>
            <div class="opcoes-conversa">
                <form action="#" method="post">
                    <?php
                        if (isset($nutricionista)) {
                            echo '<input type="hidden" name="nutricionista" value="'.$nutricionista.'">';
                        }
                    ?>
                    <div class="mb-4">
                        <label for="opcaoConversa" class="block mb-2">Escolha um tópico:</label>
                        <select id="opcaoConversa" name="opcao_conversa" class="w-full p-2 border rounded" onchange="toggleTextarea()">
                            <option value="">Selecione um tópico</option>
                            <option value="planoalimentar">Sobre o seu plano alimentar</option>
                            <option value="perda_peso">Sobre perda de peso</option>
                            <option value="ganho_peso">Sobre ganho de peso</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    <textarea id="outroOpcao" name="outro_opcao" rows="4" placeholder="Digite sua mensagem aqui..." style="display:none;" class="w-full p-2 border rounded"></textarea>
                    <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded">Enviar</button>
                </form>
            </div>
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
                <li><a href="#termos" class="hover:text-blue-400">Termos de Serviço</a></li>
                <li><a href="#privacidade" class="hover:text-blue-400">Política de Privacidade</a></li>
                <li><a href="#cookies" class="hover:text-blue-400">Política de Cookies</a></li>
            </ul>
        </div>

        <div>
            <h5 class="uppercase mb-2 font-bold">Redes Sociais</h5>
            <ul class="flex space-x-4">
                <li><a href="#facebook" class="hover:text-blue-400"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#instagram" class="hover:text-blue-400"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#twitter" class="hover:text-blue-400"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#linkedin" class="hover:text-blue-400"><i class="fab fa-linkedin"></i></a></li>
            </ul>
        </div>

        <div>
            <h5 class="uppercase mb-2 font-bold">Contato</h5>
            <ul>
                <li><i class="fas fa-envelope"></i> contato@vitalityvibe.com</li>
                <li><i class="fas fa-phone"></i> +1 234 567 890</li>
                <li><i class="fas fa-map-marker-alt"></i> 1234 Main St, Anytown, USA</li>
            </ul>
        </div>
    </div>
    <div class="bg-gray-900 text-gray-500 text-center p-4">
        &copy; 2024 VitalityVibe. Todos os direitos reservados.
    </div>
</footer>
<script src="/Projeto/js/botaoperfil.js"></script>
<script src="/Projeto/js/menususpenso.js"></script>
</body>
</html>
