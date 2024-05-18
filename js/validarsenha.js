function validarSenha() {
    var senha = document.getElementById('senha').value;
    var confirmaSenha = document.getElementById('confirmaSenha').value;

    if (senha !== confirmaSenha) {
        document.getElementById('senhaErrada').style.display = 'block';
        return false;
    } else {
        document.getElementById('senhaErrada').style.display = 'none';
        return true;
    }
}