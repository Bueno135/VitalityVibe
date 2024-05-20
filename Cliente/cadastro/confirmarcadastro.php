<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link href="C:\xampp\htdocs\Projeto\css\confirmarcadastro.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link href="/Projeto/cadastro/confirmarcadastro.css" rel="stylesheet">
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    <title>Confirmação de Login</title>
</head>
<body class="bg-gray-100">

    <header>
        <nav class="container mx-auto flex justify-between items-center py-4">
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

    <div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Confirmação de Login</h1>
        <p class="mb-4">Por favor, confirme seus dados:</p>
        <?php
        session_start();
        if (isset($_SESSION['email'])){
            include '/xampp/htdocs/Projeto/bd/connection.php';
            
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM cliente WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<div class='overflow-x-auto'>
                        <table class='min-w-full bg-white border border-gray-200'>
                            <thead class='bg-gray-50'>
                                <tr>
                                    <th class='py-2 px-4 border-b'>ID</th>
                                    <th class='py-2 px-4 border-b'>Nome</th>
                                    <th class='py-2 px-4 border-b'>Email</th>
                                    <th class='py-2 px-4 border-b'>CPF</th>
                                    <th class='py-2 px-4 border-b'>Data de Nascimento</th>
                                    <th class='py-2 px-4 border-b'>Sexo</th>
                                    <th class='py-2 px-4 border-b'>CEP</th>
                                    <th class='py-2 px-4 border-b'>Altura</th>
                                    <th class='py-2 px-4 border-b'>Peso</th>
                                    <th class='py-2 px-4 border-b'>Alergias</th>
                                    <th class='py-2 px-4 border-b'>Problema de Saúde</th>
                                </tr>
                            </thead>
                            <tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='bg-gray-50'>
                            <td class='py-2 px-4 border-b'>" . $row["ID_Cliente"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["nome"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["email"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["cpf"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["dt_nasc"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["sexo"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["cep"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["altura"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["peso"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["alergias"] . "</td>
                            <td class='py-2 px-4 border-b'>" . $row["problema_saude"] . "</td>
                        </tr>";
                }
                echo "</tbody>
                    </table>
                    </div>";
            } else {
                echo "<p class='text-red-500'>Nenhum cliente encontrado</p>";
            }
            

            $stmt->close();
            $conn->close();
        } else {
            echo "<p class='text-red-500'>Usuário não está logado</p>";
        }
        ?>
        <div class="mt-4 flex justify-between">
            <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" onclick="confirmar()">Confirmar</button>
            <button class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600" onclick="mandarEditar()">Editar informações de cadastro</button>
            <button class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600" onclick="mandarEditaAdicionais()">Editar informações pessoais</button>
        </div>
    </div>

    <script>
        function mandarEditar(){
            window.location.href = "editarcadastro.php";
        }
        function confirmar(){
            window.location.href = "/Projeto/tela.php";
        }
        function mandarEditarAdicionais(){
            window.location.href = "editarcadastro.php";
        }
    </script>
</body>
</html>
