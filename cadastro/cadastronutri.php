
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalityVibe - Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="../js/login-form.js" defer></script>
    <script src="../js/header.js" defer></script>
    <script src="../js/inicio.js" defer></script>
    <script src="../js/cpf.js" defer></script>
    <script src="../js/cep.js" defer></script>
    <script src="../js/validarCPF.js" defer></script>
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">
    <script>
        function logarUser(){
            let campos = document.querySelectorAll('#form-cadastro input, #form-cadastro select');
            let todosPreenchidos = true;

            campos.forEach(function(campo) {
                if (!campo.value) {
                    todosPreenchidos = false;
                }
            });

            if (todosPreenchidos == false) {
                alert("Por favor, preencha todos os campos do formulário.");
            } else {
                console.log('Formulário enviado');
                window.location.href = "/Projeto/cadastro/confirmarcadastro.php";
                alert("ENTREI!");
            } 
            
        }
        

    </script>

</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <header class="fixed top-0 w-full z-10 bg-white shadow-md p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="/Projeto/index.php" class="text-xl font-bold text-blue-600">VitalityVibe</a>
            <div>
                <a href="#sobre" class="mx-2 hover:text-blue-500">Sobre</a>
                <a href="#features" class="mx-2 hover:text-blue-500">Recursos</a>
                <a href="#contato" class="mx-2 hover:text-blue-500">Contato</a>
                <a href="#login" class="mx-2 hover:text-blue-500">Login</a>
                <a href="#cadastro" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Cadastre-se</a>
            </div>
        </nav>
    </header>

    <div class="h-16"></div>

    <main class="flex-grow">
 
        <section class="container mx-auto my-10 p-6">
            <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
                
   
                <div id="loginForm">
                    <h2 class="text-3xl font-bold text-center mb-6">Cadastro de Nutricionista</h2>
                    <form id="form-cadastro" method="POST" action="processa_nutri.php" onsubmit="return validarCPF()">
                        <div class="mb-6">
                            <label for="nameLogin" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="name" id="name" name="nome" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="emailLogin" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" id="emailLogin" name="email" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="passwordLogin" class="block text-sm font-medium text-gray-700">Senha</label>
                            <input type="password" id="password" name="senha" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="passwordLogin" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                            <input type="password" id="emailLogin" name="" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                            <input type="cpf" id="cpf" name="cpf" maxlength="11" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        
                        <div class="mb-6">
                            <label for="dataNascimento" class="block text-sm font-medium text-gray-700">Data de nascimento</label>
                            <input type="date" id="dataNascimento" name="dataNascimento" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        
                        <div class="mb-6">
                            <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                            <select id="sexo" name="sexo" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                                <option value="" disabled selected>Selecione...</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="outros">Outros...</option>
                            </select>
                        </div>
                        
                        
                        <div class="mb-6">
                            <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                            <input type="text" id="cep" name="cep" pattern="[0-9]{5}-[0-9]{3}" maxlength="9" placeholder="_____-__" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                    
                        </div>
                        
                        <div class="mb-6">
                            <label for="passwordLogin" class="block text-sm font-medium text-gray-700">Formação</label>
                            <input type="text" id="formacao" name="formacao" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="passwordLogin" class="block text-sm font-medium text-gray-700">Especialidade</label>
                            <input type="text" id="espec" name="espec" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="text-center">
                            <button type="button" onclick="logarUser()" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Concluir Cadastro</button>
                        </div>
                        <input type="hidden" id="senha-hash" name="senhaHash">
                    </form>
                </div>
                <div class="flex justify-center mb-6 mt-4">
                    
                    <a href="cadastronutri.php" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mx-1">Limpar Informações</a>
                </div>
                
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('form-cadastro');
            const inputs = form.querySelectorAll('input');

            // Carrega os valores dos campos do formulário do localStorage, se existirem
            inputs.forEach(input => {
                const value = localStorage.getItem(input.id);
                if (value) {    
                    input.value = value;
                }
            });

            // Salva os valores dos campos do formulário no localStorage quando houver alterações
            form.addEventListener('input', () => {
                inputs.forEach(input => {
                    localStorage.setItem(input.id, input.value);
                });
            });

            // Limpa os valores do localStorage quando o formulário é enviado
            form.addEventListener('submit', () => {
                inputs.forEach(input => {
                    localStorage.removeItem(input.id);
                });
            });
        });
    </script>

    <script>
        function editarUser() {
            // Armazena os valores do formulário no localStorage antes de redirecionar
            var formValues = {
                nome: document.getElementById('nome').value,
                email: document.getElementById('email').value,
                cpf: document.getElementById('cpf').value,
                telefone: document.getElementById('telefone').value,
                cep: document.getElementById('CEP').value,
                var: formacao = document.getElementById('formação').value,
                var: espec = document.getElementById('especialidade').value
            };
            localStorage.setItem('formValues', JSON.stringify(formValues));

            // Redireciona para a página de cadastro
            window.location.href = "/Projeto/cadastro/cadastronutri.php"
            }
    </script>

    <footer class="bg-gray-800 text-white text-center md:text-left">
        <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
           
            <div>
                <h5 class="uppercase mb-2 font-bold">Links Rápidos</h5>
                <ul>
                    <li><a href="#sobre" class="hover:text-blue-400">Sobre</a></li>
                    <li><a href="#features" class="hover:text-blue-400">Recursos</a></li>
                    <li><a href="#contato" class="hover:text-blue-400">Contato</a></li>
                    <li><a href="#login" class="hover:text-blue-400">Login</a></li>
                    <li><a href="#cadastro" class="hover:text-blue-400">Cadastre-se</a></li>
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
                <h5 class="uppercase mb-2 font-bold">Mais</h5>
                <ul>
                    <li><a href="#dicas-saude" class="hover:text-blue-400">Dicas de Saúde</a></li>
                    <li><a href="#receitas-saudaveis" class="hover:text-blue-400">Receitas Saudáveis</a></li>
                    <li><a href="#parceiros" class="hover:text-blue-400">Parceiros de Saúde</a></li>
                    <li><a href="#faq" class="hover:text-blue-400">Perguntas Frequentes</a></li>
                </ul>
            </div>
        </div>

        <div class="text-center p-4 bg-gray-700 mt-4">
            <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>