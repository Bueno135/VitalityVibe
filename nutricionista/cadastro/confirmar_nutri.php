<?php
    session_start(); // Inicia a sessão

    include '/xampp/htdocs/Projeto/bd/connection.php';

    // Verifica se o nutricionista está logado
    if (!isset($_SESSION['id'])) {
        header("Location: /Projeto/nutricionista/login/entrarnutri.php"); // Redireciona para a página de login se não estiver logado
        exit;
    }

    $id_nutricionista = $_SESSION['id'];

    $sql = "SELECT * FROM nutricionista WHERE id_nutricionista = $id_nutricionista";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Apenas um resultado esperado, então não é necessário um loop while
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link href="/Projeto/css/confirmar_nutri.css" rel="stylesheet">
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    <title>Confirmação de Login</title>
   
    <script>
        function confirmarUser() {
            window.location.href = "/Projeto/login/entrarnutri.php";
        }
        function editarUser(){
            var naoLogadoComoModerador = true;

            if (naoLogadoComoModerador) {
                Swal.fire({
                position: "top",
                icon: "info",
                title: "Você não está logado como moderador para acessar essa sessão!",
                showConfirmButton: false,
                timer: 1500
                });
            }
        }
    </script>
</head>
<body class="bg-gray-100">

    <header>
        <nav class="container mx-auto flex justify-between items-center">
            <a href="/Projeto/index.php" class="text-xl font-bold text-blue-600">VitalityVibe</a>
            <div>
                <a href="#sobre" class="mx-2 hover:text-blue-500">Sobre</a>
                <a href="#features" class="mx-2 hover:text-blue-500">Recursos</a>
                <a href="#contato" class="mx-2 hover:text-blue-500">Contato</a>
                <a href="/Projeto/cadastro/entrarnutri.php" class="mx-2 hover:text-blue-500">Login</a>
                <a href="/Projeto/cadastro/cadastronutri.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Cadastre-se</a>
            </div>
        </nav>
    </header>

    <div class="content">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Confirmação de Login</h1>
            <p class="mt-4">Por favor, confirme seus dados:</p>
            <?php
            include '/xampp/htdocs/Projeto/bd/connection.php';

            $sql = "SELECT * FROM nutricionista WHERE id_nutricionista = $id_nutricionista";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='styled-table'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Sexo</th>
                                <th>CEP</th>
                                <th>CRN</th>
                                <th>Especialidade</th>
                                <th>Formação</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_nutricionista"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["cpf"] . "</td>";
                    echo "<td>" . $row["sexo"] . "</td>";
                    echo "<td>" . $row["cep"] . "</td>";
                    echo "<td>". $row["CRN"] . "</td>";
                    echo "<td>" . $row["formacao"] . "</td>";
                    
                    $sql_especialidade = "SELECT nome_especialidade FROM especialidade WHERE id_especialidade = " . $row["id_nutricionista"];
                    $result_especialidade = $conn->query($sql_especialidade);
                    if ($result_especialidade->num_rows > 0) {
                        $row_especialidade = $result_especialidade->fetch_assoc();
                        echo "<td>" . $row_especialidade["nome_especialidade"] . "</td>";
                    } else {
                        echo "<td>Não especificada</td>";
                    }

                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "Nenhum nutricionista encontrado";
            }

            $conn->close();
            ?>


            <div class="mt-4 flex justify-between">
                <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" onclick="confirmarUser()">Confirmar</button>
                <button class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600" onclick="editarUser()">Editar</button>
            </div>
        </div>
    </div>
    

    <script>
        function confirmarUser() {
        window.location.href = "/Projeto/telanutri.php";
    }

    function editarUser() {
        window.location.href = "/Projeto/nutricionista/cadastro/editarcadastronutri.php";
    }


    </script>
</body>
</html>
