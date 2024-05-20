<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalityVibe - Login & Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    <link href="/Projeto/css/padrao.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <link rel="icon" href="imagens/logo.jpeg" type="image/x-icon">

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
                <a href="/Projeto/Cliente/cadastro/cadastrocliente.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Cadastre-se</a>
            </div>
        </nav>
    </header>
    <div class="h-16"></div>
    <main class="flex-grow">
        <section class="container mx-auto my-10 p-6">
            <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
                
                <div id="loginForm">
                    <h2 class="text-3xl font-bold text-center mb-6">Login no VitalityVibe</h2>
                    <form action="/Projeto/Cliente/login/logincliente.php"  method="POST" id="submit">
                        <div id="mensagem" class="mb-4">
                            <label for="emailLogin" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" id="emailLogin" name="email" autocomplete="off" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="mb-6">
                            <label for="passwordLogin" class="block text-sm font-medium text-gray-700">Senha</label>
                            <input type="password" id="passwordLogin" name="senha" class="bg-gray-50 mt-1 block w-full rounded-md border border-gray-300 shadow-md" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-s
                            m text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Entrar</button>
                        </div>
                        <input type="hidden" id="senha-hash" name="senhaHash">
                    </form>
                </div>
                <div class="flex justify-center mb-6 mt-4">
                    
                    <a href="/Projeto/Cliente/cadastro/cadastrocliente.php" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mx-1">Cadastre-se</a>
                    <a href="/Projeto/Cliente/login/senhacliente.php" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-900 mx-1">Alterar Senha</a>
                </div>
                
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white text-center md:text-left">
        <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <h5 class="uppercase mb-2 font-bold">Links Rápidos</h5>
                <ul>
                    <li><a href="#sobre" class="hover:text-blue-400">Sobre</a></li>
                    <li><a href="#features" class="hover:text-blue-400">Recursos</a></li>
                    <li><a href="#contato" class="hover:text-blue-400">Contato</a></li>
                    <li><a href="#login" class="hover:text-blue-400">Login</a></li>
                    <li><a href="/Projeto/Cliente/cadastro/cadastrocliente.php" class="hover:text-blue-400">Cadastre-se</a></li>
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

        <div class="footer-info">
            <p>&copy; 2024 VitalityVibe. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>
</html>
