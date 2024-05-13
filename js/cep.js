const campoCEP = document.getElementById('cep');

campoCEP.addEventListener('input', function() {
    let cep = this.value;

    // Remove todos os caracteres que não são números
    cep = cep.replace(/\D/g, '');

    // Formata o CEP adicionando o hífen
    if (cep.length > 5) {
        cep = cep.substring(0, 5) + '-' + cep.substring(5);
    }

    this.value = cep;
});