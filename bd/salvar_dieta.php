<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';

// Verifica se o ID do cliente está definido e é um número
if (isset($_POST['clienteID']) && is_numeric($_POST['clienteID'])) {
    $clienteID = $_POST['clienteID'];

    // Cria o plano alimentar
    $sqlPlano = "INSERT INTO contrato_cliente_nutricionista_planoalimentar (fk_Cliente_ID_Cliente) VALUES ($clienteID)";
    if ($conn->query($sqlPlano) === TRUE) {
        $planoID = $conn->insert_id;
        
        // Insere cada alimento como um prato
        foreach ($_POST['alimentos'] as $alimento) {
            $nomeAlimento = $alimento['nome'];
            $proteinas = $alimento['proteinas'];
            $carboidratos = $alimento['carboidratos'];
            $calorias = $alimento['calorias'];
            $quantidade = $alimento['quantidade'];
            $horario = $alimento['refeicao'];

            // Insere o prato
            $sqlPrato = "INSERT INTO Prato (nome, modo_preparo) VALUES ('$nomeAlimento', '')";
            if ($conn->query($sqlPrato) === TRUE) {
                $pratoID = $conn->insert_id;

                // Associa o prato ao plano alimentar
                $sqlPlanoPrato = "INSERT INTO PlanoAlimentarPrato (fk_PlanoAlimentar_id_plano, fk_Prato_id_prato, horario, quantidade) VALUES ($planoID, $pratoID, '$horario', $quantidade)";
                if ($conn->query($sqlPlanoPrato) !== TRUE) {
                    echo json_encode(['success' => false, 'message' => 'Erro ao associar prato ao plano alimentar.']);
                    exit;
                }

                // Insere os ingredientes do prato
                foreach ($alimento['ingredientes'] as $ingrediente) {
                    $nomeIngrediente = $ingrediente['nome'];
                    $gordura = $ingrediente['gordura'];
                    $proteina = $ingrediente['proteina'];
                    $carboidratos = $ingrediente['carboidratos'];
                    $unidade_medida = $ingrediente['unidade_medida'];
                    $calorias = $ingrediente['calorias'];
                    $categoria = $ingrediente['categoria'];

                    // Insere o ingrediente
                    $sqlIngrediente = "INSERT INTO Ingredientes (nome, gordura, proteina, carboidratos, unidade_medida, calorias, fk_CategoriaAlimentar_id_categoria) 
                                        VALUES ('$nomeIngrediente', $gordura, $proteina, $carboidratos, $unidade_medida, $calorias, $categoria)";
                    if ($conn->query($sqlIngrediente) !== TRUE) {
                        echo json_encode(['success' => false, 'message' => 'Erro ao inserir ingrediente.']);
                        exit;
                    }

                    $ingredienteID = $conn->insert_id;

                    // Associa o ingrediente ao prato na tabela Composicao
                    $sqlComposicao = "INSERT INTO Composicao (fk_Prato_id_prato, fk_Ingredientes_id_ingrediente, Quantidade) 
                                        VALUES ($pratoID, $ingredienteID, 1)";
                    if ($conn->query($sqlComposicao) !== TRUE) {
                        echo json_encode(['success' => false, 'message' => 'Erro ao associar ingrediente ao prato.']);
                        exit;
                    }
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao inserir prato.']);
                exit;
            }
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao criar plano alimentar.']);
    }
}
?>
