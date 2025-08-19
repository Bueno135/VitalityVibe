<?php require_once __DIR__ . '/../../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/csrf.php'; $csrf = csrf_token(); ?>
        <header class="fixed top-0 w-full z-10 bg-white shadow-md p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold text-blue-600">VitalityVibe</a>
            <div>
                <a href="#sobre" class="mx-2 hover:text-blue-500">Sobre</a>
                <a href="#features" class="mx-2 hover:text-blue-500">Recursos</a>
                <a href="#contato" class="mx-2 hover:text-blue-500">Contato</a>
                <a href="nutricionista/login/entrarnutri.php" class="mx-2 hover:text-blue-500">Login</a>
                <a href="nutricionista/cadastro/cadastro_nutri.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Cadastre-se</a>
            </div>
        </nav>
    </header>

    <div class="h-16"></div>

    <main class="flex-grow">
        <section class="container mx-auto my-10 p-6">
            <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
                
                <div id="cadastroForm">
                    <h2 class="text-3xl font-bold text-center mb-6">Cadastro de Nutricionista</h2>
                    <form id="form-cadastro" method="POST" action="processa_nutri.php">
<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf, ENT_QUOTES); ?>">
                    <div class="mb-6">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" id="nome" name="nome" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="emailLogin" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" id="emailLogin" name="email" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                         <div class="mb-6">
                            <label for="passwordLogin" class="block text-sm font-medium text-gray-700">Senha</label>
                            <input type="password" id="senha" name="senha" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="passwordLogin" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                            <input type="password" id="confirmarSenha" name="" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                            <input id="cpf" name="cpf" inputmode="numeric" maxlength="11" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                         <div class="mb-6">
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input inputmode="numeric" id="telefone" name="telefone" maxlength="11" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
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
                            <input type="text" id="cep" name="cep" inputmode="numeric" pattern="[0-9]{5}-[0-9]{3}" maxlength="9" placeholder="_____-__" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div> 
                        <div class="mb-6">
                            <label for="crn" class="block text-sm font-medium text-gray-700">CRN</label>
                            <input type="text" id="crn" name="crn" inputmode="numeric" maxlength="7" placeholder="CRN1-11" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div> 
                        <div class="mb-6">
                            <label for="formacao" class="block text-sm font-medium text-gray-700">Formação</label>
                            <input type="text" id="formacao" name="formacao" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="espec" class="block text-sm font-medium text-gray-700">Especialidade</label>
                            <input type="text" id="especialidade" name="especialidade" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                       
                        <div class="text-center">
                            <button type="submit" id="resultado" onclick="armazenar()"  value="Enviar" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Concluir Cadastro</button>
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
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>