<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalityVibe - Editar cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="../js/cep.js" defer></script>
    <script src="../js/telefone.js" defer></script>
    <script src="../js/cpf.js" defer></script>
    <script src="../js/validarCPF.js" defer></script>
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



$sql_last_id = "SELECT id_nutricionista FROM nutricionista ORDER BY id_nutricionista DESC LIMIT 1";
$result_last_id = $conn->query($sql_last_id);

if ($result_last_id->num_rows > 0) {
    $row_last_id = $result_last_id->fetch_assoc();
    $last_id = $row_last_id['id_nutricionista'];

    $sql_select = "SELECT * FROM nutricionista WHERE id_nutricionista = $last_id";
    $result_select = $conn->query($sql_select);
    
        if ($result_select->num_rows > 0) {
            $nutricionista = $result_select->fetch_assoc();
    
            
            $sql_especialidade = "SELECT nome_especialidade FROM especialidade WHERE id_especialidade = " . $nutricionista['fk_Especialidade_id_especialidade'];
            echo 'ID Especialidade: ' . $nutricionista['fk_Especialidade_id_especialidade'];
            $result_especialidade = $conn->query($sql_especialidade);
            if ($result_especialidade->num_rows > 0) {
                $row_especialidade = $result_especialidade->fetch_assoc();
                $nutricionista['especialidade'] = $row_especialidade['nome_especialidade'];
            } else {
                $nutricionista['especialidade'] = 'Não especificada';
            }

        
        $sql_formacao = "SELECT nome_formacao FROM formacao WHERE id_formacao = " . $nutricionista['id_formacao'];
        $result_formacao = $conn->query($sql_formacao);
        if ($result_formacao->num_rows > 0) {
            $row_formacao = $result_formacao->fetch_assoc();
            $nutricionista['formacao'] = $row_formacao['nome_formacao'];
        } else {
            $nutricionista['formacao'] = 'Não especificada';
        }

        $nome = $nutricionista['nome'];
        $email = $nutricionista['email'];
        $cpf = $nutricionista['cpf'];
        $telefone = $nutricionista['telefone'];
        $cep = $nutricionista['cep'];
        $formacao = $nutricionista['formacao'];
        $especialidade = $nutricionista['especialidade'];
    } else {
        echo "Nutricionista não encontrado";
    }
} else {
    echo "Não há nutricionistas cadastrados";
}

$conn->close();
?>



        <header class="fixed top-0 w-full z-10 bg-white shadow-md p-4">
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
                            <label for="formacao" class="block text-sm font-medium text-gray-700">Formação</label>
                            <input type="text" id="formacao" name="formacao" value="<?php echo $nutricionista['formacao']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="espec" class="block text-sm font-medium text-gray-700">Especialidade</label>
                            <input type="text" id="especialidade" name="especialidade" value="<?php echo $nutricionista['especialidade']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
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
    </script>


</body>
</html>

</body>

 
   
</html>