function formatarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    cpf = cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4');
    return cpf;
}

function formatarCEP(cep) {
    cep = cep.replace(/\D/g, '');
    cep = cep.replace(/^(\d{5})(\d{3})$/, '$1-$2');
    return cep;
}

function formatarTelefone(telefone) {
    telefone = telefone.replace(/\D/g, '');
    telefone = telefone.replace(/^(\d{2})(\d{4,5})(\d{4})$/, '($1) $2-$3');
    return telefone;
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('cpf').addEventListener('input', function() {
        this.value = formatarCPF(this.value);
    });

    document.getElementById('cep').addEventListener('input', function() {
        this.value = formatarCEP(this.value);
    });

    document.getElementById('telefone').addEventListener('input', function() {
        this.value = formatarTelefone(this.value);
    });
});
