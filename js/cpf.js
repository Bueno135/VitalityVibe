function formatarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    
    cpf = cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4');
    
    return cpf;
}

const campoCPF = document.getElementById('cpf');

campoCPF.addEventListener('input', function() {
    let cpf = this.value;

    cpf = formatarCPF(cpf);

    this.value = cpf;
});