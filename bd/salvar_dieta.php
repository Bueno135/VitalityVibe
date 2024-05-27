<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

// Verifica se a solicitação é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $clienteID = $_POST['ID_Cliente'];
    $dieta = $_POST['dieta']; // Supondo que dieta seja uma string estruturada com informações necessárias

    // Insere a dieta na tabela PlanoAlimentar
    $sql_dieta = "INSERT INTO PlanoAlimentar (fk_Cliente_ID_Cliente, observacoes) VALUES (?, ?)";
    $stmt_dieta = $conn->prepare($sql_dieta);
    $stmt_dieta->bind_param("is", $clienteID, $dieta);
    $stmt_dieta->execute();

    // Obtém o ID da dieta inserida
    $planoalimentarID = $stmt_dieta->insert_id;

    // Estrutura da string dieta: "nome_prato|ingrediente1,quantidade1,gordura1,proteina1,carboidratos1,calorias1|..."
    $pratos = explode("||", $dieta);
    foreach ($pratos as $prato) {
        // Estrutura de cada prato: "nome_prato|ingrediente1,quantidade1,gordura1,proteina1,carboidratos1,calorias1|..."
        $dados_prato = explode("|", $prato);
        $nome_prato = $dados_prato[0];

        // Insere o prato na tabela Prato
        $sql_prato = "INSERT INTO Prato (nome) VALUES (?)";
        $stmt_prato = $conn->prepare($sql_prato);
        $stmt_prato->bind_param("s", $nome_prato);
        $stmt_prato->execute();

        // Obtém o ID do prato inserido
        $pratoID = $stmt_prato->insert_id;

        // Insere na tabela intermediária PlanoAlimentarPrato
        $sql_intermediaria = "INSERT INTO PlanoAlimentarPrato (fk_PlanoAlimentar_id_plano, fk_Prato_id_prato) VALUES (?, ?)";
        $stmt_intermediaria = $conn->prepare($sql_intermediaria);
        $stmt_intermediaria->bind_param("ii", $planoalimentarID, $pratoID);
        $stmt_intermediaria->execute();

        // Processa os ingredientes do prato
        for ($i = 1; $i < count($dados_prato); $i++) {
            $ingrediente_dados = explode(",", $dados_prato[$i]);
            $nome_ingrediente = $ingrediente_dados[0];
            $quantidade = $ingrediente_dados[1];
            $gordura = $ingrediente_dados[2];
            $proteina = $ingrediente_dados[3];
            $carboidratos = $ingrediente_dados[4];
            $calorias = $ingrediente_dados[5];

            // Insere o ingrediente na tabela Ingredientes
            $sql_ingrediente = "INSERT INTO Ingredientes (nome, gordura, proteina, carboidratos, unidade_medida, calorias, fk_CategoriaAlimentar_id_categoria) 
                                VALUES (?, ?, ?, ?, 1, ?, 1)"; // Ajuste o valor do unidade_medida e categoria conforme necessário
            $stmt_ingrediente = $conn->prepare($sql_ingrediente);
            $stmt_ingrediente->bind_param("sddddi", $nome_ingrediente, $gordura, $proteina, $carboidratos, $calorias, $categoria_id);
            $stmt_ingrediente->execute();

            // Obtém o ID do ingrediente inserido
            $ingredienteID = $stmt_ingrediente->insert_id;

            // Insere na tabela intermediária Composicao
            $sql_composicao = "INSERT INTO Composicao (fk_Prato_id_prato, fk_Ingredientes_id_ingrediente, Quantidade) VALUES (?, ?, ?)";
            $stmt_composicao = $conn->prepare($sql_composicao);
            $stmt_composicao->bind_param("iid", $pratoID, $ingredienteID, $quantidade);
            $stmt_composicao->execute();
        }
    }

    // Fechar conexões e redirecionar
    $stmt_dieta->close();
    $stmt_prato->close();
    $stmt_intermediaria->close();
    $stmt_ingrediente->close();
    $stmt_composicao->close();
    $conn->close();

    echo "Dieta salva com sucesso!";
} else {
    echo "Erro ao salvar a dieta. Por favor, tente novamente.";
}
?>
