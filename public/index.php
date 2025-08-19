<?php require_once __DIR__ . '/includes/header.php'; ?>
<?php require_once __DIR__ . '/includes/csrf.php'; $csrf = csrf_token(); ?>

    <!-- Cabeçalho -->
    <header class="fixed top-0 w-full z-10 bg-white shadow-md p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold text-blue-600">VitalityVibe</a>
            <div id="header-nav">
                <a href="#sobre" class="mx-2 hover:text-blue-500">Sobre</a>
                <a href="#features" class="mx-2 hover:text-blue-500">Recursos</a>
                <a href="#contato" class="mx-2 hover:text-blue-500">Contato</a>
                <a href="Cliente/login/entrarcliente.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Cliente</a>
                <a href="nutricionista/login/entrarnutri.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Nutricionista</a>
            </div>
        </nav>
    </header>

    <!-- Seção Hero -->
    <section class="hero bg-cover bg-center h-screen" style="background-image: url('imagens/fundo.jpg');">
        <div class="container mx-auto text-center flex justify-center items-center h-full">
            <div class="text-white bg-black bg-opacity-50 p-6 rounded-lg">
                <h1 class="text-5xl font-bold mb-4">Alimentação Saudável Simplificada</h1>
                <p class="text-xl mb-8">Me diga sobre você, como deseja ingressar em nossa plataforma?</p>
                <a href="Cliente/login/entrarcliente.php" class="bg-white text-blue-500 py-3 px-6 rounded-lg font-semibold hover:bg-gray-100">Sou(a) Cliente</a>
                <a href="nutricionista/login/entrarnutri.php" class="bg-white text-blue-500 py-3 px-6 rounded-lg font-semibold hover:bg-gray-100">Sou(a) Nutricionista</a>
                
            </div>
        </div>
    </section>


    <!-- Sobre o Serviço -->
    <section id="sobre" class="container mx-auto text-center py-12">
        <h2 class="text-3xl font-bold mb-6">Sobre o VitalityVibe</h2>
        <p class="text-lg mx-auto leading-relaxed max-w-4xl">O VitalityVIbe é sua plataforma de nutrição personalizada...</p>
    </section>

    <!-- Recursos -->
    <section id="features" class="py-12">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8">Recursos Principais</h2>
            <div class="flex flex-wrap justify-center gap-6">
                <!-- Card 1: Diário de Alimentos -->
                <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-5">
                        <div class="text-blue-500 text-3xl mb-3"><i class="fas fa-utensils"></i></div>
                        <h5 class="text-xl font-semibold mb-3">Diário de Alimentos</h5>
                        <p class="text-gray-600 text-sm">Registre suas refeições e lanches, monitorando sua ingestão nutricional diariamente para manter uma dieta equilibrada e saudável.</p>
                    </div>
                </div>

                <!-- Card 2: Planos de Refeição Personalizados -->
                <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-5">
                        <div class="text-green-500 text-3xl mb-3"><i class="fas fa-seedling"></i></div>
                        <h5 class="text-xl font-semibold mb-3">Planos de Refeição Personalizados</h5>
                        <p class="text-gray-600 text-sm">Receba planos de refeição adaptados às suas preferências alimentares, restrições dietéticas e objetivos de saúde, tudo personalizado por nossa IA NutriPersona.</p>
                    </div>
                </div>

                <!-- Card 3: Avaliação Nutricional Personalizada -->
                <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-5">
                        <div class="text-pink-500 text-3xl mb-3"><i class="fas fa-heartbeat"></i></div>
                        <h5 class="text-xl font-semibold mb-3">Avaliação Nutricional Personalizada</h5>
                        <p class="text-gray-600 text-sm">Beneficie-se de uma avaliação nutricional completa, personalizada de acordo com seu estilo de vida, preferências alimentares e objetivos de saúde, contribuindo para uma jornada de bem-estar mais informada e eficaz.</p>
                    </div>
                </div>
                

                <!-- Card 4: Informações Nutricionais Detalhadas -->
                <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-5">
                        <div class="text-purple-500 text-3xl mb-3"><i class="fas fa-apple-alt"></i></div>
                        <h5 class="text-xl font-semibold mb-3">Informações Nutricionais Detalhadas</h5>
                        <p class="text-gray-600 text-sm">Obtenha informações detalhadas sobre o conteúdo nutricional de suas refeições, incluindo calorias, proteínas, carboidratos, gorduras e vitaminas, para tomar decisões alimentares informadas.</p>
                    </div>
                </div>

                <!-- Card 5: Acompanhamento do Progresso -->
                <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-5">
                        <div class="text-orange-500 text-3xl mb-3"><i class="fas fa-chart-line"></i></div>
                        <h5 class="text-xl font-semibold mb-3">Acompanhamento do Progresso</h5>
                        <p class="text-gray-600 text-sm">Monitore seu progresso em direção às suas metas de saúde e bem-estar, visualizando seu histórico de refeições e hábitos alimentares ao longo do tempo.</p>
                    </div>
                </div>

                <!-- Card 6: Consultas com Nutricionistas -->
                <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-5">
                        <div class="text-teal-500 text-3xl mb-3"><i class="fas fa-user-md"></i></div>
                        <h5 class="text-xl font-semibold mb-3">Consultas com Nutricionistas</h5>
                        <p class="text-gray-600 text-sm">Agende consultas virtuais com nutricionistas profissionais para obter orientações personalizadas e aprimorar sua jornada para uma vida mais saudável.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    
        <!-- Avaliações de Clientes -->
        <section id="avaliacoes" class="py-12">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center mb-8">Avaliações de Clientes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                    <!-- Card de Avaliação 1 -->
                    <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
                        <div class="text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="text-gray-600 text-sm text-center">"Adorei a facilidade de planejar minhas refeições com o CleverEats. Mudou minha rotina!"</p>
                        <span class="text-gray-800 font-semibold mt-2">- João Silva</span>
                    </div>
                
                    <!-- Card de Avaliação 2 -->
                    <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
                        <div class="text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm text-center">"Estou impressionada com os recursos de nutrição. Excelente para quem leva a saúde a sério!"</p>
                        <span class="text-gray-800 font-semibold mt-2">- Ana Pereira</span>
                    </div>
                
                    <!-- Card de Avaliação 3 -->
                    <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
                        <div class="text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="text-gray-600 text-sm text-center">"Como alguém que adora cozinhar, as receitas e a comunidade são incríveis. Muito inspirador!"</p>
                        <span class="text-gray-800 font-semibold mt-2">- Carlos Gomes</span>
                    </div>
                
                    <!-- Card de Avaliação 4 -->
                    <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
                        <div class="text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm text-center">"Finalmente um aplicativo que entende minhas necessidades dietéticas. Super recomendo!"</p>
                        <span class="text-gray-800 font-semibold mt-2">- Sofia Martins</span>
                    </div>
                
                    <!-- Card de Avaliação 5 -->
                    <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
                        <div class="text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm text-center">"A funcionalidade de acompanhamento nutricional é um diferencial. Ajuda muito no meu dia a dia!"</p>
                        <span class="text-gray-800 font-semibold mt-2">- Rafael Costa</span>
                    </div>
                </div>
            </div>
        </section>



    <!-- Rodapé -->
    <footer class="bg-gray-800 text-white text-center md:text-left">
        <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Links para seções do site -->
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

            <!-- Informações legais e políticas de uso -->
            <div>
                <h5 class="uppercase mb-2 font-bold">Legal</h5>
                <ul>
                    <li><a href="#termos-de-uso" class="hover:text-blue-400">Termos de Uso</a></li>
                    <li><a href="#privacidade" class="hover:text-blue-400">Política de Privacidade</a></li>
                </ul>
            </div>

            <!-- Informações de contato -->
            <div>
                <h5 class="uppercase mb-2 font-bold">Contato</h5>
                <ul>
                    <li><a href="mailto:info@clevereats.com" class="hover:text-blue-400">info@vitalityvibe.com</a></li>
                    <li><a href="tel:+123456789" class="hover:text-blue-400">+1 234 567 89</a></li>
                </ul>
            </div>

            <!-- Outras informações -->
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
<?php require_once __DIR__ . '/includes/footer.php'; ?>