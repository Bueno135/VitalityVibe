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
</head>
<body class="bg-gray-100">

    <header>
        <nav class="container mx-auto flex justify-between items-center">
            <a href="/Projeto/index.php" class="text-xl font-bold text-blue-600">VitalityVibe</a>
            <div>
                <a href="#sobre" class="mx-2 hover:text-blue-500">Sobre</a>
                <a href="#features" class="mx-2 hover:text-blue-500">Recursos</a>
                <a href="#contato" class="mx-2 hover:text-blue-500">Contato</a>
                <a href="/Projeto/login/entrarcliente.php" class="mx-2 hover:text-blue-500">Login</a>
                <a href="/Projeto/cadastro/cadastrocliente.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Cadastre-se</a>
            </div>
        </nav>
    </header>

    <div class="content">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Confirmação de Login</h1>
            <p class="mt-4">Por favor, confirme seus dados:</p>
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

$sql = "SELECT * FROM cliente ORDER BY ID_Cliente DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='styled-table'
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Sexo</th>
                <th>CEP</th>
                <th>altura</th>
                <th>peso</th>
                <th>alergias</th>
                <th>problema_saude</th>
                
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID_Cliente"] . "</td>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["cpf"] . "</td>";
        echo "<td>" . $row["dt_nasc"] . "</td>";
        echo "<td>" . $row["sexo"] . "</td>";
        echo "<td>" . $row["cep"] . "</td>";
        echo "<td>" . $row["altura"] . "</td>";
        echo "<td>" . $row["peso"] . "</td>";
        echo "<td>" . $row["alergias"] . "</td>";
        echo "<td>" . $row["problema_saude"] . "</td>";

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum cliente encontrado";
}

$conn->close();
?>
            <div class="mt-4 flex justify-between">
                <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" onclick="confirmar()">Confirmar</button>
                <button class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600" onclick="mandarEditar()">Editar</button>
            </div>
        </div>
    </div>
<script>
    function mandarEditar(){
        window.location.href = "editarcadastro.php";
    }
    function confirmar(){
        window.location.href = "entrarcliente.php";
    }

</script>
</body>
</html>
