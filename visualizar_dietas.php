<?php
include '/xampp/htdocs/Projeto/bd/connection.php';
include '/xampp/htdocs/Projeto/bd/protect.php';

// Verifica se o nutricionista está logado
if (!isset($_SESSION['id']) || !is_numeric($_SESSION['id'])) {
    echo "ID de nutricionista inválido.";
    exit; // Para a execução do script
}

// ID do nutricionista logado
$nutricionistaID = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Dietas - VitalityVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="/Projeto/css/atendimento.css" rel="stylesheet">
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-left text-blue-600 logo"><a href="telanutri.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <div class="relative">
            <button id="profileDropdown" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
                <i class="fas fa-user-circle fa-lg text-white"></i> <span class="text-white"><?php echo $_SESSION['nome']; ?></span>
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
            <h2>Dietas Criadas - VitalityVibe</h2>
            <div class="opcoes-conversa">
                <h3>Dietas criadas:</h3>
                <?php
                // Consulta o banco de dados para obter as dietas do contrato do nutricionista
                $sql = "SELECT p.id_plano, p.nome_dieta, p.descricao, p.quantidade, p.refeicao
                        FROM contrato_cliente_nutricionista_planoalimentar ccnp
                        JOIN planoalimentar p ON ccnp.fk_PlanoAlimentar_id_plano = p.id_plano
                        WHERE ccnp.fk_Nutricionista_ID_Nutricionista = ?";
                
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("i", $nutricionistaID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Exibir as dietas do contrato
                        while($row = $result->fetch_assoc()) {
                            $idPlano = $row['id_plano'];
                            $nomeDieta = $row['nome_dieta'];
                            $descricao = $row['descricao'];
                            $quantidade = $row['quantidade'];
                            $refeicao = $row['refeicao'];

                            echo "<div class='dieta'>";
                            echo "<p><strong>Nome da Dieta:</strong> $nomeDieta</p>";
                            echo "<p><strong>Descrição:</strong> $descricao</p>";
                            echo "<p><strong>Quantidade:</strong> $quantidade g/ml</p>";
                            echo "<p><strong>Refeição:</strong> $refeicao</p>";

                            // Consulta para obter os alimentos do plano alimentar
                            $sqlAlimentos = "SELECT nome_ingrediente, proteinas, carboidratos, calorias, gordura
                                             FROM planoalimentar
                                             WHERE fk_plano_alimentar_id = ?";
                            if ($stmtAlimentos = $conn->prepare($sqlAlimentos)) {
                                $stmtAlimentos->bind_param("i", $idPlano);
                                $stmtAlimentos->execute();
                                $resultAlimentos = $stmtAlimentos->get_result();

                                if ($resultAlimentos->num_rows > 0) {
                                    echo "<ul>";
                                    while ($rowAlimento = $resultAlimentos->fetch_assoc()) {
                                        $nomeIngrediente = $rowAlimento['nome_ingrediente'];
                                        $proteinas = $rowAlimento['proteinas'];
                                        $carboidratos = $rowAlimento['carboidratos'];
                                        $calorias = $rowAlimento['calorias'];
                                        echo "<li><strong>Ingrediente:</strong> $nomeIngrediente - <strong>Proteínas:</strong> $proteinas g - <strong>Carboidratos:</strong> $carboidratos g - <strong>Calorias:</strong> $calorias kcal</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo "<p>Nenhum alimento encontrado para esta dieta.</p>";
                                }

                                $stmtAlimentos->close();
                            } else {
                                echo "Erro na preparação da consulta de alimentos: " . $conn->error;
                            }

                            echo "</div>";
                        }
                    } else {
                        echo "<p>Nenhuma dieta encontrada para este nutricionista.</p>";
                    }

                    $stmt->close();
                } else {
                    echo "Erro na preparação da consulta: " . $conn->error;
                }

                $conn->close();
                ?>
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
            </ul>
        </div>

        <div>
            <h5 class="uppercase mb-2 font-bold">Legal</h5>
            <ul>
                <li><a href="#termos-de-uso" class="hover:text-blue-400">Termos de Uso</a></li>
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
            <h5 class="uppercase mb-2 font-bold">Redes Sociais</h5>
            <ul class="flex justify-center md:justify-start">
                <li><a href="#" class="hover:text-blue-400 mx-2"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#" class="hover:text-blue-400 mx-2"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" class="hover:text-blue-400 mx-2"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#" class="hover:text-blue-400 mx-2"><i class="fab fa-linkedin"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="bg-gray-900 text-gray-400 text-center p-4">
        © 2023 VitalityVibe. Todos os direitos reservados.
    </div>
</footer>

<script>
    document.getElementById("profileDropdown").addEventListener("click", function() {
        var profileInfo = document.getElementById("profileInfo");
        if (profileInfo.classList.contains("hidden")) {
            profileInfo.classList.remove("hidden");
        } else {
            profileInfo.classList.add("hidden");
        }
    });

    document.addEventListener("click", function(event) {
        var profileInfo = document.getElementById("profileInfo");
        if (!profileInfo.contains(event.target) && !event.target.matches("#profileDropdown")) {
            profileInfo.classList.add("hidden");
        }
    });

    function deslogar() {
        window.location.href = '/Projeto/bd/logout.php';
    }

    function editarperfilnutri() {
        window.location.href = '/Projeto/html/editarnutriform.php';
    }
</script>
</body>
</html>
