<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

// Verifica se a solicitação é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $clienteID = $_POST['ID_Cliente'];
    $dieta = $_POST['dieta'];

    // Insere a dieta na tabela planoalimentar
    $sql_dieta = "INSERT INTO planoalimentar (fk_cliente_ID_Cliente, descricao) VALUES (?, ?)";
    $stmt_dieta = $conn->prepare($sql_dieta);
    $stmt_dieta->bind_param("is", $clienteID, $dieta);
    $stmt_dieta->execute();

    // Obtém o ID da dieta inserida
    $planoalimentarID = $stmt_dieta->insert_id;

    // Insere cada alimento na tabela prato
    $alimentos = explode("|", $dieta);
    foreach ($alimentos as $alimento) {
        $dados_alimento = explode(",", $alimento);
        $nome = $dados_alimento[0];
        $proteinas = $dados_alimento[1];
        $carboidratos = $dados_alimento[2];
        $calorias = $dados_alimento[3];
        $quantidade = $dados_alimento[4];
        $horario = $dados_alimento[5];

        $sql_alimento = "INSERT INTO prato (fk_planoalimentar_ID_PlanoAlimentar, nome, proteinas, carboidratos, calorias, quantidade, horario) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_alimento = $conn->prepare($sql_alimento);
        $stmt_alimento->bind_param("isiiids", $planoalimentarID, $nome, $proteinas, $carboidratos, $calorias, $quantidade, $horario);
        $stmt_alimento->execute();
    }

    // Fechar conexões e redirecionar
    $stmt_dieta->close();
    $stmt_alimento->close();
    $conn->close();

    echo "Dieta salva com sucesso!";
} else {
    echo "Erro ao salvar a dieta. Por favor, tente novamente.";
}
?>
