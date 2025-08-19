

## Passo 3 (Cliente – Cadastro/Editar + Layout)
- `Cliente/cadastro/processa_cadastro.php`: migração para **prepared statements** (SELECT cpf/email e INSERT de cadastro), com backup `processa_cadastro.prestmt.bak.php`.
- Normalizados redirecionamentos `/Projeto/...` restantes no módulo de cadastro.
- Aplicados `includes/header.php` e `includes/footer.php` nas telas: `index.php`, `Cliente/login/entrarcliente.php`, `Cliente/cadastro/cadastrocliente.php`, `nutricionista/login/entrarnutri.php`, `nutricionista/cadastro/cadastronutri.php`.
