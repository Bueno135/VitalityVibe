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
    
</head>
<body class="bg-gray-100">

    <header>
        <nav class="container mx-auto flex justify-between items-center">
            <a href="/Projeto/index.php" class="text-xl font-bold text-blue-600">VitalityVibe</a>
            <div>
                <a href="#sobre" class="mx-2 hover:text-blue-500">Sobre</a>
                <a href="#features" class="mx-2 hover:text-blue-500">Recursos</a>
                <a href="#contato" class="mx-2 hover:text-blue-500">Contato</a>
                <a href="/Projeto/cadastro/entrarcliente.php" class="mx-2 hover:text-blue-500">Login</a>
                <a href="/Projeto/cadastro/cadastrocliente.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Cadastre-se</a>
            </div>
        </nav>
    </header>

    <div class="content">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Confirmação de Login</h1>
            <p class="mt-4">Por favor, confirme seus dados:</p>
            <?php
// Conexão com o banco de dados
include '/xampp/htdocs/Projeto/bd/connection.php';

// Query para obter os dados dos clientes
$sql = "SELECT * FROM cliente ORDER BY ID_Cliente DESC LIMIT 1";
$result = $conn->query($sql);

// Verifica se a consulta retornou resultados
if ($result->num_rows > 0) {
    // Exibir cabeçalho da tabela
    echo "<table class='styled-table'
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Sexo</th>
                <th>CEP</th>
                
            </tr>";

    // Loop através dos resultados
    while ($row = $result->fetch_assoc()) {
        // Exibir dados de cada cliente em uma linha da tabela
        echo "<tr>";
        echo "<td>" . $row["ID_Cliente"] . "</td>";
        echo "<td>" . $row["Nome"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["cpf"] . "</td>";
        echo "<td>" . $row["dt_nasc"] . "</td>";
        echo "<td>" . $row["sexo"] . "</td>";
        echo "<td>" . $row["CEP"] . "</td>";
        echo "</tr>";
    }

    // Fechar tabela
    echo "</table>";
} else {
    echo "Nenhum cliente encontrado";
}

// Fechar conexão
$conn->close();
?>
<?php
    // Se houver dados no localStorage, exiba-os no formulário
    if (localStorage.getItem('formValues')) {
        const formValues = JSON.parse(localStorage.getItem('formValues'));
        document.getElementById('name').value = formValues.name;
        document.getElementById('email').value = formValues.email;
        // Preencha outros campos conforme necessário
    }
?>

<script>
        function confirmarUser() {
            window.location.href = "/Projeto/login/entrarcliente.php";
        }
        function editarUser(){
            // Armazena os valores do formulário no localStorage antes de redirecionar
            const formValues = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value
                // Adicione outros campos conforme necessário
            };
            localStorage.setItem('formValues', JSON.stringify(formValues));

            window.location.href = "/Projeto/cadastro/cadastrocliente.php";
        }
    </script>
            <div class="mt-4 flex justify-between">
                <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" onclick="confirmarUser()">Confirmar</button>
                <button class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600" onclick="editarUser()">Editar</button>
            </div>
        </div>
    </div>
    <script>
        function confirmarUser() {
            window.location.href = "/Projeto/login/entrarcliente.php";
        }
        function editarUser(){
            window.location.href = "/Projeto/cadastro/cadastrocliente.php"
        }
    </script>
    <script>
        function editarUser(){
        // Armazena os valores do formulário no localStorage antes de redirecionar
        var formValues = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value
            // Adicione outros campos conforme necessário
        };
        localStorage.setItem('formValues', JSON.stringify(formValues));

        window.location.href = "/Projeto/cadastro/cadastrocliente.php";
    }
    </script>



</body>


</html>

