# Deploy no Vercel (PHP Runtime comunitário)

Este projeto foi adaptado para rodar no **Vercel** usando o runtime **PHP** da comunidade (`vercel-php`).

## Estrutura
- `public/` → suas páginas PHP/HTML (views) e estáticos (`assets/`, `imagens/`).
- `app/` → includes e conexão com o banco (`app/includes`, `app/bd`).
- `api/index.php` → front controller que roteia as URLs para arquivos em `public/`.
- `vercel.json` → configura o runtime PHP e os rewrites.

## Pré-requisitos
- **Vercel CLI** (`npm i -g vercel`)
- **Conta no Vercel** e um **projeto** criado
- **MySQL** acessível na internet (Railway, PlanetScale, Neon/MySQL, etc.)

## Variáveis de ambiente
Configure no dashboard do Vercel (Project → Settings → Environment Variables):
- `DB_HOST` (ex.: `aws.connect.psdb.cloud`)
- `DB_PORT` (ex.: `3306`)
- `DB_USER`
- `DB_PASS`
- `DB_NAME`

> Em desenvolvimento local você pode usar `app/bd/config.php` (baseado no `config.example.php`).

## Como rodar local
```bash
# Requisitos: PHP 8.1+ instalado
php -S localhost:8000 api/index.php
```

## Deploy
```bash
vercel login
vercel
```

- O Vercel lerá `vercel.json`:
  - `/assets/*` e `/imagens/*` são servidos de `public/` (estático).
  - Qualquer outra rota é roteada para `api/index.php`, que inclui o arquivo PHP correto em `public/`.

## Observações
- **Sessões PHP** em serverless: a extensão está disponível no runtime, porém o filesystem é efêmero. Para produção, considere:
  - armazenar sessão em **Redis** (Upstash Redis) ou
  - usar **JWT**/**tokens**.
- **CSRF**: atualmente baseado em sessão. Se notar inconsistências, podemos migrar para **double-submit cookie**.
- **Tempo de execução**: para endpoints mais pesados, é possível aumentar `memory`/`maxDuration` na função em `vercel.json`.
