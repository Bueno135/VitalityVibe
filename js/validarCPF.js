function validarCPF() {
    var cpf = document.getElementById('cpf').value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText === 'exists') {
                alert('CPF já cadastrado');
                return false; // Impede o envio do formulário antes da resposta do servidor
            } else {
                return true;
            }
        }
    };
    xhr.open("POST", "cpfexistente.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("cpf=" + cpf);
    // return false; // Não deve ser chamado aqui
}