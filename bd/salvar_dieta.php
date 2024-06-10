<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';

$data = json_decode(file_get_contents("php://input"), true);

$clienteID = $data['clienteID'];
$alimentos = $data['alimentos'];

// Cria o plano alimentar
$sqlPlano = "INSERT INTO PlanoAlimentar (ID_Cliente) VALUES ($clienteID)";
if ($conn->query($sqlPlano) === TRUE) {
    $planoID = $conn->insert_id;
    
    // Insere cada alimento como um prato
    foreach ($alimentos as $alimento) {
        $nomeAlimento = $alimento['nome'];
        $proteinas = $alimento['proteinas'];
        $carboidratos = $alimento['carboidratos'];
        $calorias = $alimento['calorias'];
        $quantidade = $alimento['quantidade'];
        $horario = $alimento['horario'];

        // Insere o prato
        $sqlPrato = "INSERT INTO Prato (nome, proteinas, carboidratos, calorias) VALUES ('$nomeAlimento', $proteinas, $carboidratos, $calorias)";
        if ($conn->query($sqlPrato) === TRUE) {
            $pratoID = $conn->insert_id;
            
            // Associa o prato ao plano alimentar
            $sqlPlanoPrato = "INSERT INTO PlanoAlimentarPrato (ID_PlanoAlimentar, ID_Prato, horario, quantidade) VALUES ($planoID, $pratoID, '$horario', $quantidade)";
            if ($conn->query($sqlPlanoPrato) !== TRUE) {
                echo json_encode(['success' => false, 'message' => 'Erro ao associar prato ao plano alimentar.']);
                exit;
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
?>
