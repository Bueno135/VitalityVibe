<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
session_start();

// Verifica se o nutricionista está logado
if (!isset($_SESSION['id'])) {
    echo "<p>Nutricionista não conectado. <a href='entrarnutri.php'>Login</a></p>";
    exit();
}

// ID do nutricionista logado
$nutricionistaID = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimento - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="/Projeto/css/atendimento.css" rel="stylesheet">
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/Projeto/js/botaoperfil.js"></script>
    <script src="/Projeto/js/menususpenso.js"></script>
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    <style>
        .message-preview {
            cursor: pointer;
        }

        .message-content {
            display: none;
        }

        .message-preview.active + .message-content {
            display: block;
        }

        .message-actions {
            display: none;
        }

        .message-preview.active + .message-content + .message-actions {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-left text-blue-600 logo"><a href="telanutri.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <div class="relative">
            <button id="profileDropdown" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
                <i class="fas fa-user-circle fa-lg"></i> <?php echo $_SESSION['nome']; ?>
            </button>
            <div id="profileInfo" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                <p class="block px-4 py-2 text-sm text-gray-700">Nome: <?php echo ucwords($_SESSION['nome']); ?></p>
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
        <div class="max-w-lg mx-auto nutricionista-box">
            <h2>Atendimento - VitalityVibe</h2>
            <div class="opcoes-conversa">
                <h3>Mensagens recebidas:</h3>
                <?php
                // Consulta para obter as mensagens do nutricionista logado
                $sql_mensagens = "SELECT * FROM mensagem WHERE fk_nutricionista_id_nutricionista = ?";
                $stmt = $conn->prepare($sql_mensagens);
                $stmt->bind_param("i", $nutricionistaID);
                $stmt->execute();
                $result_mensagens = $stmt->get_result();

                if ($result_mensagens->num_rows > 0) {
                    while($row_mensagem = $result_mensagens->fetch_assoc()) {
                        $id_mensagem = $row_mensagem['id_mensagem'];
                        $mensagem = $row_mensagem['mensagem'];
                        $data_envio = $row_mensagem['data_envio'];
                        echo "<div class='message-preview' data-id='{$id_mensagem}'>";
                        echo "<p><strong>Horário:</strong> $data_envio</p>";
                        echo "</div>";
                        echo "<div class='message-content'>";
                        echo "<p><strong>Conteúdo:</strong> $mensagem</p>";
                        echo "</div>";
                        echo "<div class='message-actions'>";
                        echo "<button class='accept-button' data-id='{$id_mensagem}'>Aceitar</button>";
                        echo "<button class='reject-button' onclick='deletarMensagem($id_mensagem)' data-id='{$id_mensagem}'>Rejeitar</button>";
                        echo "</div>";
                        echo "<hr>";
                    }
                } else {
                    echo "<p>Nenhuma mensagem encontrada.</p>";
                }

                $stmt->close();
                $conn->close();
                ?>
                <button type="button" onclick="window.location.href='telanutri.php'">Voltar</button>
            </div>
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
                <li><a href="#login" class="hover:text-blue-400">Login</a></li>
                <li><a href="/Projeto/cadastro/cadastronutri.php" class="hover:text-blue-400">Cadastre-se</a></li>
            </ul>
        </div>

        <div>
            <h5 class="uppercase mb-2 font-bold">Legal</h5>
            <ul>
                <li><a href="#termos-de-uso" class="
hover:text-blue-400">Termos de Uso</a></li>
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
                <li><a href="#receitas-saudaveis" class="hover:text-blue-400">Parceiros de Saúde</a></li>
                <li><a href="#faq" class="hover:text-blue-400">Perguntas Frequentes</a></li>
            </ul>
        </div>
    </div>

    <script>
    document.querySelectorAll('.message-preview').forEach(item => {
            item.addEventListener('click', event => {
                item.classList.toggle('active');
            });
        });

        document.querySelectorAll('.accept-button').forEach(item => {
            item.addEventListener('click', event => {
                const messageId = item.getAttribute('data-id');
                // Faça alguma ação com a mensagem aceita, por exemplo:
                // window.location.href = `/Projeto/aceitar.php?id=${messageId}`;
            });
        });

        document.querySelectorAll('.reject-button').forEach(item => {
            item.addEventListener('click', event => {
                const messageId = item.getAttribute('data-id');
                // Faça alguma ação com a mensagem rejeitada, por exemplo:
                // window.location.href = `/Projeto/rejeitar.php?id=${messageId}`;
            });
        });

        function toggleMessage(messageId) {
    var message = document.getElementById("message_" + messageId);
    message.classList.toggle("active");
}

function deletarMensagem(id_mensagem) {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Esta ação não pode ser revertida!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, deletar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Requisição AJAX para deletar a mensagem
            $.ajax({
                type: 'POST',
                url: '/Projeto/deletar_mensagem.php',
                data: { id_mensagem: id_mensagem },
                success: function(response) {
                    // Atualiza a página após a deleção
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Exibe um alerta em caso de erro
                    Swal.fire('Erro!', 'Ocorreu um erro ao deletar a mensagem.', 'error');
                }
            });
        }
    });
}
document.getElementById("profileDropdown").addEventListener("click", function() {
        var dropdown = document.getElementById("profileInfo");
        dropdown.classList.toggle("hidden");
    });

    </script>
    <div class="footer-info">
        <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
    </div>
</footer>

</body>
</html>
