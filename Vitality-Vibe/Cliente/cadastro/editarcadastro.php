<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalityVibe - Editar cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="/Projeto/js/cep.js" defer></script>
    <script src="/Projeto/js/telefone.js" defer></script>
    <script src="/Projeto/js/cpf.js" defer></script>
    <script src="/Projeto/js/validarCPF.js" defer></script>
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

        if (!isset($_SESSION['ID_Cliente'])) {
            header("Location: tela.php");
            exit;
        }

        $email = $_SESSION['email'];

        $stmt = $conn->prepare("SELECT * FROM cliente WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $cliente = $result->fetch_assoc();

            $nome = $cliente['nome'];
            $email = $cliente['email'];
            $dt_nasc = $cliente['dt_nasc'];
            $sexo = $cliente['sexo'];
            $cpf = $cliente['cpf'];
            $telefone = $cliente['telefone'];
            $cep = $cliente['cep'];
            
        } else {
            echo "Cliente não encontrado";
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
                    <h2 class="text-3xl font-bold text-center mb-6">Editar cadastro</h2>
                    <form id="form-cadastro" method="POST" action="editar.php">
                    <div class="mb-6">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>"
                             class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="emailLogin" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" id="emailLogin" name="email" value="<?php echo $cliente['email']; ?>"class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                            <input id="cpf" name="cpf" inputmode="numeric" maxlength="11" value="<?php echo $cliente['cpf']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                         <div class="mb-6">
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input inputmode="numeric" id="telefone" name="telefone" maxlength="11" value="<?php echo $cliente['telefone']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        </div>
                        <div class="mb-6">
                            <label for="dt_nasc" class="block text-sm font-medium text-gray-700">Data de nascimento</label>
                            <input type="date" id="dt_nasc" name="dt_nasc" value="<?php echo $cliente['dt_nasc']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div id="idadeAviso" class="hidden text-red-500 mb-4">Site Proibido Para Menores de 16 Anos.</div>
                        <div class="mb-6">
                            <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                            <select id="sexo" name="sexo" value="<?php echo $cliente['sexo']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                                <option value="" disabled selected>Selecione...</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                            <input type="text" id="cep" name="cep" inputmode="numeric" pattern="[0-9]{5}-[0-9]{3}" maxlength="9" placeholder="_____-__" value="<?php echo $cliente['cep']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
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
