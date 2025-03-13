function editarperfil(){
    window.location.href = '/Projeto/Cliente/Cadastro/confirmarcadastro.php';
}


function toggleProfileInfo() {
    var profileInfo = document.getElementById('profileInfo');
    if (profileInfo.classList.contains('hidden')) {
        profileInfo.classList.remove('hidden');
    } else {
        profileInfo.classList.add('hidden');
    }
}

function deslogar(){
    fetch('/Projeto/Cliente/perfil/logout.php', {
    method: 'POST',
    credentials: 'same-origin'
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url; // Redireciona para a página de login
        }
    })
    .catch(error => {
        console.error('Erro ao fazer logout:', error);
    });
}