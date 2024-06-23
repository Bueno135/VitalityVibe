<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';

if (isset($_POST['clienteID']) && is_numeric($_POST['clienteID'])) {
    $clienteID = $_POST['clienteID'];
    $nutricionistaID = $_SESSION['id'];
    $nomePlano = $_POST['nome_dieta']; // Receba o nome do plano do formulário

    $conn->begin_transaction();

    $dataInicio = date("Y-m-d");

    // Insere o plano alimentar na tabela PlanoAlimentar
    $sqlPlanoAlimentar = "INSERT INTO PlanoAlimentar (nome_pratos, nome_dieta, refeicao, dia_semana, horario, observacoes) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtPlanoAlimentar = $conn->prepare($sqlPlanoAlimentar);

    // Percorre os alimentos e insere os dados no banco de dados
    if (isset($_POST['alimentos']) && is_array($_POST['alimentos'])) {
        foreach ($_POST['alimentos'] as $alimento) {
            $nomeAlimento = $alimento['nomeAlimento'];
            $refeicao = $alimento['refeicao'];
            $diaSemana = $alimento['diaSemana'];
            $horario = $alimento['horarioAlimento'];
            $observacoes = $alimento['observacoes'];

            $stmtPlanoAlimentar->bind_param("ssssss", $nomeAlimento, $nomePlano, $refeicao, $diaSemana, $horario, $observacoes);

            if (!$stmtPlanoAlimentar->execute()) {
                $conn->rollback();
                echo "Erro ao inserir plano alimentar: " . $stmtPlanoAlimentar->error;
                exit();
            }
        }
    }

    // Associa o plano alimentar ao cliente e nutricionista na tabela contrato_cliente_nutricionista_planoalimentar
    $planoID = $conn->insert_id;
    $sqlContrato = "INSERT INTO contrato_cliente_nutricionista_planoalimentar (fk_Cliente_ID_Cliente, fk_Nutricionista_ID_Nutricionista, fk_PlanoAlimentar_id_plano, dt_inic) VALUES (?, ?, ?, ?)";
    $stmtContrato = $conn->prepare($sqlContrato);
    $stmtContrato->bind_param("iiis", $clienteID, $nutricionistaID, $planoID, $dataInicio);

    if ($stmtContrato->execute()) {
        $conn->commit();
        echo "Plano alimentar criado com sucesso.";
        header("Location: /Projeto/telanutri.php");
        exit();
    } else {
        $conn->rollback();
        echo "Erro ao associar plano alimentar ao contrato: " . $stmtContrato->error;
        exit();
    }
} else {
    echo "ID de cliente inválido.";
    exit();
}
?>
