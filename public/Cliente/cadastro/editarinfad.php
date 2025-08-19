<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalityVibe - Editar cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="js/cep.js" defer></script>
    <script src="js/telefone.js" defer></script>
    <script src="js/cpf.js" defer></script>
    <script src="js/validarCPF.js" defer></script>
    <link rel="icon" href="/imagens/logo.jpeg" type="image/x-icon">
    <style>
    .mb-6{
        margin-bottom: 1.5rem;
    }
    </style></head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<?php
    require_once __DIR__ . '/../../bd/connection.php';
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

    if ($result_select->num_rows > 0) {
        $cliente = $result_select->fetch_assoc();

        $objetivo = $cliente["objetivo"];
        $peso = $cliente['peso'];
        $alergias = $cliente['alergias'];
        $problema_saude = $cliente['problema_saude'];
        $med_controlado = $cliente['med_controlado'];
    } else {
        echo "Cliente não encontrado";
    }

$conn->close();
?>

        <header class="fixed top-0 w-full z-10 bg-white shadow-md p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold text-blue-600">VitalityVibe</a>
            <div>
                <a href="#sobre" class="mx-2 hover:text-blue-500">Sobre</a>
                <a href="#features" class="mx-2 hover:text-blue-500">Recursos</a>
                <a href="#contato" class="mx-2 hover:text-blue-500">Contato</a>
                <a href="login/entrarcliente.php" class="mx-2 hover:text-blue-500">Login</a>
                <a href="cadastro/cadastrocliente.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Cadastre-se</a>
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
                            <label for="obj" class="block text-sm font-medium text-gray-700">Objetivo</label>
                            <select id="obj" name="objetivo" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                                <option value="" disabled selected>Selecione...</option>
                                <option value="perda">Perda de Peso</option>
                                <option value="ganho">Ganho de Peso</option>
                                <option value="saude">Melhora na Saúde</option>
                                <option value="atletica">Melhora na Performace Atlética</option>
                                <option value="epesificas">Melhora em Condições Específicas</option>
                                <option value="habitos">Melhoria dos Hábitos Alimentares</option>
                                <option value="disturbios">Construir um Controle de Distúrbios Alimentares</option>
                                <option value="outros">Outros...</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="problem" class="block text-sm font-medium text-gray-700">Você tem algum problema de saúde? Se sim, qual(s)?</label>
                            <input type="text" id="problem" name="problema_saude" value="<?php echo $cliente['problema_saude']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="med" class="block text-sm font-medium text-gray-700">Você utiliza de algum medicamento controlado? Se sim qual(s)?</label>
                            <input type="text" id="med" name="medicamentoControlado" value="<?php echo $cliente['med_controlado']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="alergias" class="block text-sm font-medium text-gray-700">Você é alergico a algum alimento? Se sim, qual(s)?</label>
                            <input type="text" id="alergias" name="alergias" value="<?php echo $cliente['alergias']; ?>" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="peso" class="block text-sm font-medium text-gray-700">Qual o seu peso?(Em Quilograma/Kg)</label>
                            <input type="text" id="Peso" name="peso" inputmode="numeric" pattern="[0-9]*" maxlength="3"  value="<?php echo $cliente['peso']; ?>"  class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
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
