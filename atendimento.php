<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';

// Verifica se o nutricionista está logado
if (!isset($_SESSION['id'])) {
    echo "<p>Nutricionista não conectado. <a href='entrarnutri.php'>Login</a></p>";
    exit();
}

// ID do nutricionista logado
$nutricionistaID = $_SESSION['id'];

// Processa a ação de aceitar ou rejeitar a mensagem
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mensagem_id']) && isset($_POST['acao'])) {
    $mensagemID = $_POST['mensagem_id'];
    $acao = $_POST['acao'];

    if ($acao == 'aceitar') {
        // Ação de aceitar a mensagem
        // Enviar aviso para o cliente
        $sql_cliente = "SELECT fk_Cliente_ID_Cliente FROM mensagem WHERE id_mensagem = ?";
        $stmt_cliente = $conn->prepare($sql_cliente);
        $stmt_cliente->bind_param("i", $mensagemID);
        $stmt_cliente->execute();
        $result_cliente = $stmt_cliente->get_result();
    
        if ($result_cliente->num_rows > 0) {
            $row_cliente = $result_cliente->fetch_assoc();
            $clienteID = $row_cliente['fk_Cliente_ID_Cliente'];
    
            // Aqui você pode enviar a mensagem para o cliente
            // Por exemplo, se tiver uma tabela de mensagens para o cliente, insira a mensagem lá
            $mensagem_cliente = "Seu atendimento foi aceito.";
            $sql_enviar_mensagem = "INSERT INTO mensagem (fk_Cliente_ID_Cliente, fk_Nutricionista_id_nutricionista, mensagem, data_envio, lida, opcao_conversa) VALUES (?, ?, ?, NOW(), 'N', 'Resposta')";
            $stmt_enviar_mensagem = $conn->prepare($sql_enviar_mensagem);
            $stmt_enviar_mensagem->bind_param("iis", $clienteID, $nutricionistaID, $mensagem_cliente);
            $stmt_enviar_mensagem->execute();
    
            // Excluir a mensagem aceita
            $sql_excluir_mensagem = "DELETE FROM mensagem WHERE id_mensagem = ?";
            $stmt_excluir_mensagem = $conn->prepare($sql_excluir_mensagem);
            $stmt_excluir_mensagem->bind_param("i", $mensagemID);
            $stmt_excluir_mensagem->execute();
    
            // Exibir mensagem de sucesso e redirecionar
            echo "<script>
                    alert('Atendimento aceito! Aviso enviado para o cliente e mensagem excluída.');
                    window.location.href = 'atendimento.php';
                  </script>";
        }
    } elseif ($acao == 'rejeitar') {
        if (isset($_POST['motivo'])) {
            $motivo = $_POST['motivo'];

            // Enviar mensagem de rejeição para o cliente
            $sql_cliente = "SELECT fk_Cliente_ID_Cliente FROM mensagem WHERE id_mensagem = ?";
            $stmt_cliente = $conn->prepare($sql_cliente);
            $stmt_cliente->bind_param("i", $mensagemID);
            $stmt_cliente->execute();
            $result_cliente = $stmt_cliente->get_result();

            if ($result_cliente->num_rows > 0) {
                $row_cliente = $result_cliente->fetch_assoc();
                $clienteID = $row_cliente['fk_Cliente_ID_Cliente'];

                $mensagem_rejeicao = "Seu atendimento foi rejeitado.";
                $motivo_mensagem = "$motivo";
                $sql_enviar_mensagem = "INSERT INTO mensagem (fk_Cliente_ID_Cliente, fk_Nutricionista_id_nutricionista, mensagem, data_envio, lida, opcao_conversa, outro_opcao) VALUES (?, ?, ?, NOW(), 'N', 'Resposta', ?)";
                $stmt_enviar_mensagem = $conn->prepare($sql_enviar_mensagem);
                $stmt_enviar_mensagem->bind_param("iiss", $clienteID, $nutricionistaID, $mensagem_rejeicao, $motivo_mensagem);
                $stmt_enviar_mensagem->execute();

                // Excluir a mensagem rejeitada
                $sql_excluir_mensagem = "DELETE FROM mensagem WHERE id_mensagem = ?";
                $stmt_excluir_mensagem = $conn->prepare($sql_excluir_mensagem);
                $stmt_excluir_mensagem->bind_param("i", $mensagemID);
                $stmt_excluir_mensagem->execute();

                // Exibir mensagem de sucesso e redirecionar
                echo "<script>
                        alert('Atendimento rejeitado! Aviso enviado para o cliente e mensagem excluída.');
                        window.location.href = 'atendimento.php';
                      </script>";
            }
        }
    }
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
   
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
                
                        // Verifica se a opção de conversa não é "Resposta"
                        if ($row_mensagem['opcao_conversa'] !== 'Resposta') {
                            echo "<div class='message-preview' data-id='{$id_mensagem}'>";
                            echo "<p><strong>Horário:</strong> $data_envio</p>";
                            echo "</div>";
                            echo "<div class='message-content'>";
                            echo "<p><strong>Conteúdo:</strong> $mensagem</p>";
                            echo "</div>";
                            echo "<div class='message-actions'>";
                            echo "<form method='POST' action='atendimento.php'>";
                            echo "<input type='hidden' name='mensagem_id' value='{$id_mensagem}'>";
                            echo "<button type='submit' name='acao' value='aceitar' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Aceitar</button>";
                            echo "<button type='button' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded' onclick='showRejectionModal($id_mensagem)'>Rejeitar</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "<hr>";
                        }
                    }
                } else {
                    echo "<p>Nenhuma mensagem recebida.</p>";
                }
                ?>
            </div>
        </div>
    </section>
</main>

<footer class="bg-gray-200 text-center py-4 mt-auto">
    <p>&copy; 2023 VitalityVibe. Todos os direitos reservados.</p>
</footer>

<script>
$(document).ready(function() {
    $(".message-preview").click(function() {
        var id = $(this).data('id');
        $(".message-preview").removeClass('active');
        $(".message-content").hide();
        $(".message-actions").hide();
        $(this).addClass('active');
        $(this).next(".message-content").show();
        $(this).next(".message-content").next(".message-actions").show();
    });
});

function deslogar() {
    window.location.href = "logout.php";
}

function editarperfilnutri() {
    window.location.href = "editar_perfil.php";
}

function showRejectionModal(mensagemId) {
    Swal.fire({
        title: 'Motivo da Rejeição',
        input: 'text',
        inputLabel: 'Insira o motivo da rejeição',
        inputPlaceholder: 'Motivo...',
        showCancelButton: true,
        confirmButtonText: 'Rejeitar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (motivo) => {
            if (!motivo) {
                Swal.showValidationMessage('Por favor, insira um motivo');
            }
            return motivo;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const motivo = result.value;
            $.ajax({
                type: 'POST',
                url: 'atendimento.php',
                data: { mensagem_id: mensagemId, acao: 'rejeitar', motivo: motivo },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Atendimento rejeitado!',
                        text: 'Aviso enviado para o cliente e mensagem excluída.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire('Erro!', 'Ocorreu um erro ao rejeitar a mensagem.', 'error');
                }
            });
        }
    });
}

</script>
<script src="/Projeto/js/botaoperfil.js"></script>
<script src="/Projeto/js/menususpenso.js"></script>
</body>
</html>
