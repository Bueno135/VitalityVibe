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
        
        if (!$stmt_nutricionista) {
            die("Preparação da consulta falhou: " . $conn->error);
        }

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
        
        if (!$stmt) {
            die("Preparação da consulta falhou: " . $conn->error);
        }

        $stmt->bind_param("sssii", $mensagem, $opcao_conversa, $outro_opcao, $nutricionistaID, $clienteID);

        if ($stmt->execute()) {
            echo "<p>Dúvida enviada com sucesso. <a href='/Projeto/tela.php'>Voltar</a></p>";
        } else {
            echo "<p>Erro ao enviar a dúvida: " . $stmt->error . ". <a href='/Projeto/contatarnutri.php?nutricionista=" . $nutricionista . "'>Tentar novamente</a></p>";
        }

        return;
    }
}
?>
