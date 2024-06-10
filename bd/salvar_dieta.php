<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';

if (isset($_POST['clienteID']) && is_numeric($_POST['clienteID'])) {
    $clienteID = $_POST['clienteID'];
    $nutricionistaID = $_SESSION['id'];
    $nomePlano = $_POST['nomePlano']; // Receba o nome do plano do formulário

    $descricaoPlano = '';
    if (isset($_POST['alimentos']) && is_array($_POST['alimentos'])) {
        foreach ($_POST['alimentos'] as $alimento) {
            $nomeAlimento = $alimento['nome'];
            $proteinas = $alimento['proteinas'];
            $carboidratos = $alimento['carboidratos'];
            $calorias = $alimento['calorias'];
            $quantidade = $alimento['quantidade'];
            $horario = $alimento['refeicao'];

            $descricaoPlano .= "Nome: $nomeAlimento, Proteínas: $proteinas, Carboidratos: $carboidratos, Calorias: $calorias, Quantidade: $quantidade, Horário: $horario\n";
        }
    }

    // Verificação para depuração
    error_log("Descrição do Plano: " . $descricaoPlano);

    $conn->begin_transaction();

    // Insere o plano alimentar na tabela PlanoAlimentar
    $sqlPlanoAlimentar = "INSERT INTO PlanoAlimentar (nome_dieta, descricao) VALUES (?, ?)";
    $stmtPlanoAlimentar = $conn->prepare($sqlPlanoAlimentar);
    $stmtPlanoAlimentar->bind_param("ss", $nomePlano, $descricaoPlano);

    if ($stmtPlanoAlimentar->execute()) {
        $planoID = $conn->insert_id;

        // Associa o plano alimentar ao cliente e nutricionista na tabela contrato_cliente_nutricionista_planoalimentar
        $sqlContrato = "INSERT INTO contrato_cliente_nutricionista_planoalimentar (fk_Cliente_ID_Cliente, fk_Nutricionista_ID_Nutricionista, fk_PlanoAlimentar_id_plano) VALUES (?, ?, ?)";
        $stmtContrato = $conn->prepare($sqlContrato);
        $stmtContrato->bind_param("iii", $clienteID, $nutricionistaID, $planoID);

        if ($stmtContrato->execute()) {
            $conn->commit();
            echo "Plano alimentar criado com sucesso.";
            header("Location: /Projeto/telanutri.php");
            exit();
        } else {
            $conn->rollback();
            echo "Erro ao associar plano alimentar ao contrato.";
            exit();
        }
    } else {
        $conn->rollback();
        echo "Erro ao criar plano alimentar.";
        exit();
    }
} else {
    echo "ID de cliente inválido.";
    exit;
}
?>
