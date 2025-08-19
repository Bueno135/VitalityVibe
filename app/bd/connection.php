<?php
// DB connection for Vercel & local
// Order of precedence: Environment variables -> bd/config.php -> defaults

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$name = getenv('DB_NAME') ?: 'vitalityvibe';

// Allow override via bd/config.php when running locally
$configFile = __DIR__ . '/config.php';
if (file_exists($configFile)) {
    $cfg = include $configFile;
    if (is_array($cfg)) {
        $host = $cfg['host']     ?? $host;
        $port = $cfg['port']     ?? $port;
        $user = $cfg['user']     ?? $user;
        $pass = $cfg['password'] ?? $pass;
        $name = $cfg['database'] ?? $name;
    }
}

$servername = $host . ':' . $port;
$conn = new mysqli($servername, $user, $pass, $name);
if ($conn->connect_error) {
    http_response_code(500);
    die('Erro de conexão: ' . htmlspecialchars($conn->connect_error));
}
