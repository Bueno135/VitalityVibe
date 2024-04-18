const campoTelefone = document.getElementById('telefone');

campoTelefone.addEventListener('input', function() {
let telefone = this.value;


telefone = telefone.replace(/\D/g, '');


telefone = telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');

this.value = telefone;
});