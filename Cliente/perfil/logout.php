<?php
// Inicia a sessão
session_start();

// Destrói todas as variáveis de sessão
$_SESSION = array();

// Se necessário, destrói a sessão
session_destroy();

// Redireciona o usuário para a página inicial
header("Location: /Projeto/index.php");
exit;

