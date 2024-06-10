<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalityVibe - Editar cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="/Projeto/js/formatarcampos.js" defer></script>
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    <style>
    .mb-6{
        margin-bottom: 1.5rem;
    }
    </style>

</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<?php

include '/xampp/htdocs/Projeto/bd/connection.php';
session_start();
$id_sessaonutri = $_SESSION['id']; // Supondo que você já tenha essa variável de sessão

$sql_select = "SELECT * FROM nutricionista WHERE id_nutricionista = $id_sessaonutri";
$result_select = $conn->query($sql_select);

if ($result_select->num_rows > 0) {
    $nutricionista = $result_select->fetch_assoc();

    $sql_especialidade = "SELECT nome_especialidade FROM especialidade WHERE id_especialidade = ?";
    $stmt = $conn->prepare($sql_especialidade);
    $stmt->bind_param("i", $nutricionista['fk_Especialidade_id_especialidade']);
    $stmt->execute();
    $result_especialidade = $stmt->get_result();

    if ($result_especialidade->num_rows > 0) {
        $row_especialidade = $result_especialidade->fetch_assoc();
        $nutricionista['especialidade'] = $row_especialidade['nome_especialidade'];
    } else {
        $nutricionista['especialidade'] = 'Não especificada';
    }

    
    $nome = $nutricionista['nome'];
    $email = $nutricionista['email'];
    $cpf = $nutricionista['cpf'];
    $telefone = $nutricionista['telefone'];
    $cep = $nutricionista['cep'];
    $CRN = $nutricionista['CRN'];
    $formacao = $nutricionista['formacao'];

} else {
    echo "Nutricionista não encontrado";
}

$conn->close();
?>





<header class="fixed top-0 w-full z-10 bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-left text-blue-600 logo"><a href="telanutri.php">VitalityVibe</a></h1>
    <div class="flex items-center">
        <div class="relative">
            <button id="profileDropdown" class="text-gray-600 hover:text-blue-600 mr-4 focus:outline-none">
                <i class="fas fa-user-circle fa-lg"></i> <?php echo $_SESSION['nome']; ?>
            </button>
            <div id="profileInfo" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                <p class="block px-4 py-2 text-sm text-gray-700">Nome: <?php echo $_SESSION['nome'] = ucwords($_SESSION['nome']); ?></p>
                <p class="block px-4 py-2 text-sm text-gray-700">Email: <?php echo $_SESSION['email']; ?></p>
                <button id="openProfileInfo" onclick="deslogar()" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">Deslogar</button>
                <button id="editarperfil" onclick="editarperfilnutri()" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">Editar perfil</button>
            </div>
        </div>
    </div>
</header>

    <div class="h-16"></div>

    <main class="flex-grow">
        <section class="container mx-auto my-10 p-6">
            <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
                
                <div id="cadastroForm">
                    <h2 class="text-3xl font-bold text-center mb-6">Editar cadastro do nutricionista</h2>
                    <form id="form-cadastro" method="POST" action="editarnutri.php">
                    <div class="mb-6">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" id="nome" name="nome" value="<?php echo $nutricionista['nome']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="emailLogin" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" id="emailLogin" name="email" value="<?php echo $nutricionista['email']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
        
                        <div class="mb-6">
                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                            <input id="cpf" name="cpf" inputmode="numeric" maxlength="11" value="<?php echo $nutricionista['cpf']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                         <div class="mb-6">
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input inputmode="numeric" id="telefone" name="telefone" maxlength="11" value="<?php echo $nutricionista['telefone']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                
                        <div class="mb-6">
                            <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                            <select id="sexo" name="sexo" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                                <option value="" disabled selected>Selecione...</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                            <input type="text" id="cep" name="cep" inputmode="numeric" value="<?php echo $nutricionista['cep']; ?>" pattern="[0-9]{5}-[0-9]{3}" maxlength="9" placeholder="_____-__" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div> 
                        <div class="mb-6">
                            <label for="CRN" class="block text-sm font-medium text-gray-700">CRN</label>
                            <input type="text" id="CRN" name="CRN" inputmode="numeric" maxlength="7" placeholder="CRN1-11" value="<?php echo $nutricionista['CRN'];?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div> 
                        <div class="mb-6">
                            <label for="formacao" class="block text-sm font-medium text-gray-700">Formação</label>
                            <input type="text" id="formacao" name="formacao" value="<?php echo $nutricionista['formacao']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="resultado"  value="Enviar" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Concluir Cadastro</button>
                        </div>
                        <input type="hidden" id="senha-hash" name="senhaHash">
                    </form>
                </div>
                 <div class="flex justify-center mb-6 mt-4">
                     <a href="cadastrocliente.php" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mx-1">Limpar Informações</a>
                </div>
                
            </div>
        </section>
    </main> 

    <script>
        function verificarIdade() {
            var dataNascimento = new Date(document.getElementById('dt_nasc').value);
            var hoje = new Date();
            var idade = hoje.getFullYear() - dataNascimento.getFullYear();
            var mes = hoje.getMonth() - dataNascimento.getMonth();

            if (mes < 0 || (mes === 0 && hoje.getDate() < dataNascimento.getDate())) {
                idade--;
            }

            if (idade < 16) {
                document.getElementById('idadeAviso').classList.remove('hidden');
                return false;
            } else {
                document.getElementById('idadeAviso').classList.add('hidden');
                return true;
            }
        }

        document.getElementById('form-cadastro').addEventListener('submit', function(event) {
            if (!verificarIdade()) {
                event.preventDefault();
            }
        });
    </script>
    <script>
        const campoAltura = document.getElementById('Altura');

        campoAltura.addEventListener('input', function() {
            let altura = this.value;

            altura = altura.replace(/\D/g, '');

            if (altura.length >= 3) {
                altura = altura.substring(0, altura.length - 2) + '.' + altura.substring(altura.length - 2);
            }

            this.value = altura;
        });

        document.getElementById("profileDropdown").addEventListener("click", function() {
    var dropdown = document.getElementById("profileInfo");
    dropdown.classList.toggle("hidden");
});
    </script>


</body>
</html>

</body>

 
   
</html>