<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link href="/Projeto/cadastro/confirmarcadastro.css" rel="stylesheet">
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    <title>Confirmação de Login</title>
    <style>
     
        body {
            margin: 0;
            padding: 0;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white;
            z-index: 1000;
            padding: 1rem; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
        }
        .content {
            margin-top: 4rem;
            padding: 1rem;
        }
    </style>
    <script>
        function confirmarUser() {
            window.location.href = "/Projeto/login/entrarnutri.php";
        }
        function editarUser(){
            var naoLogadoComoModerador = true;

            // Se o usuário não estiver logado como moderador, exiba o alerta
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

$sql = "SELECT * FROM nutricionista ORDER BY id_nutricionista DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='styled-table'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Sexo</th>
                <th>CEP</th>
                <th>Especialidade</th>
                <th>Formação</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_nutricionista"] . "</td>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["cpf"] . "</td>";
        echo "<td>" . $row["sexo"] . "</td>";
        echo "<td>" . $row["cep"] . "</td>";
        
        // Consulta SQL para obter a especialidade do nutricionista
        $sql_especialidade = "SELECT nome_especialidade FROM especialidade WHERE id_especialidade = " . $row["id_nutricionista"];
        $result_especialidade = $conn->query($sql_especialidade);
        if ($result_especialidade->num_rows > 0) {
            $row_especialidade = $result_especialidade->fetch_assoc();
            echo "<td>" . $row_especialidade["nome_especialidade"] . "</td>";
        } else {
            echo "<td>Não especificada</td>";
        }
        
        // Consulta SQL para obter a formação do nutricionista
        $sql_formacao = "SELECT nome_formacao FROM formacao WHERE id_formacao = " . $row["id_nutricionista"];
        $result_formacao = $conn->query($sql_formacao);
        if ($result_formacao->num_rows > 0) {
            $row_formacao = $result_formacao->fetch_assoc();
            echo "<td>" . $row_formacao["nome_formacao"] . "</td>";
        } else {
            echo "<td>Não especificada</td>";
        }

        echo "</tr>";
    }
    echo "</table>";
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
    
</body>
</html>

