<?php
    require_once __DIR__ . '/../../bd/connection.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitality Vibe - Login & Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="../js/profile.js" defer></script>
    <link href="css/padrao.css" rel="stylesheet">
    <link rel="icon" href="/imagens/logo.jpeg" type="image/x-icon"></head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <header class="fixed top-0 w-full z-10 bg-white shadow-md p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold text-blue-600">VitalityVibe</a>
            <div>
                <a href="#sobre" class="mx-2 hover:text-blue-500">Sobre</a>
                <a href="#features" class="mx-2 hover:text-blue-500">Recursos</a>
                <a href="#contato" class="mx-2 hover:text-blue-500">Contato</a>
                <a href="#login" class="mx-2 hover:text-blue-500">Login</a>
            </div>
        </nav>
    </header>

    <div class="h-16"></div>
    <div class="h-16"></div>
    <div class="h-16"></div>

    <section class="container mx-auto my-0 p-6">
        <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
            <h2 id="userName" class="text-3xl font-bold text-center mb-6">Altere Sua Senha</h2>

            <form id="changePasswordForm" method="post" action="senhanutrinova.php" onsubmit="return validarSenha()">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Coloque seu email</label>
                    <input name="email" onblur="verificar()" type="email" id="email" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4 relative">
                    <label for="newPassword" class="block text-sm font-medium text-gray-700">Insira sua nova Senha</label>
                    <div class ="relative">
                        <input name="nova_senha" type="password" id="newPassword" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-sm pr-10" required>
                        <button type="button" onclick="togglepassword('newPassword', 'toggleIcon')" class="absolute inset-y-0 right-0 px-3 flex items-center text-sm leading-5">
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-4 relative">
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirme sua nova Senha</label>
                    <div class ="relative">
                        <input name="confirm_senha" type="password" id="confirmPassword" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-sm pr-10" required>
                        <button type="button" onclick="togglepassword('confirmPassword', 'toggleConfirmIcon')" class="absolute inset-y-0 right-0 px-3 flex items-center text-sm leading-5">
                            <i id="toggleConfirmIcon" class="fas fa-eye"></i>
                        </button>
                        <span id="senhaMatch" class="text-red-500 text-sm hidden">As senhas não coincidem.</span>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Alterar Senha</button>
                </div>
            </form>
        </div>
    </section>

    <footer class="bg-gray-800 text-white text-center md:text-left mt-auto">
        <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <h5 class="uppercase mb-2 font-bold">Links Rápidos</h5>
                <ul>
                    <li><a href="#sobre" class="hover:text-blue-400">Sobre</a></li>
                    <li><a href="#features" class="hover:text-blue-400">Recursos</a></li>
                    <li><a href="#contato" class="hover:text-blue-400">Contato</a></li>
                    <li><a href="#login" class="hover:text-blue-400">Login</a></li>

                    <li><a href="Cliente/cadastro/cadastrocliente.php" class="hover:text-blue-400">Cadastre-se</a></li>

                    <li><a href="paginas/entrar" class="hover:text-blue-400">Cadastre-se</a></li>
                </ul>
                <ul>
                    <li><a href="#termos-de-uso" class="hover:text-blue-400">Termos de Uso</a></li>
                    <li><a href="#privacidade" class="hover:text-blue-400">Política de Privacidade</a></li>
                </ul>
            </div>
            <div>
                <h5 class="uppercase mb-2 font-bold">Contato</h5>
                <ul>
                    <li><a href="mailto:info@vitalityvibe.com" class="hover:text-blue-400">info@vitalityvibe.com</a></li>
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
        <div class="footer-info">
            <p>&copy; 2024 Vitality Vibe. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script>
        function verificar() {
            const email = document.getElementById('email').value;
            if (email === '<?php echo $_SESSION["email"]?>') {
                alert('email válido');
            } else {
                alert('email inválido');
            }
        }

        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            var toggleIcon = document.getElementById('toggleIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function validarSenha() {
            var newPassword = document.getElementById('newPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            var senhaMatch = document.getElementById('senhaMatch');

            if (newPassword !== confirmPassword) {
                senhaMatch.classList.remove('hidden');
                return false;
            } else {
                senhaMatch.classList.add('hidden');
                return true;
            }
        }
    </script>
</body>
</html>
