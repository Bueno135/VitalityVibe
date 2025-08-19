<?php
declare(strict_types=1);

/**
 * Vercel PHP front controller
 * - Routes any request to the corresponding file under /public
 * - Supports "/dir" -> "/dir/index.php" and "/file" -> "/file.php"
 * - Blocks path traversal outside of /public
 */

// Absolute path to /public
$publicDir = realpath(__DIR__ . '/../public');
if ($publicDir === false) {
    http_response_code(500);
    echo 'Public directory not found.';
    exit;
}

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH) ?: '/';

// Normalize: strip trailing slash (but keep root)
if ($path !== '/' && substr($path, -1) === '/') {
    $path = rtrim($path, '/');
}

// Build target path
$target = $publicDir . ($path === '/' ? '/index.php' : $path);

// If it's a directory, load its index.php
if (is_dir($target)) {
    $target = rtrim($target, '/') . '/index.php';
}

// If it's an extensionless path and a .php file exists, use it
if (!pathinfo($target, PATHINFO_EXTENSION)) {
    if (is_file($target . '.php')) {
        $target .= '.php';
    }
}

// Resolve and security-check
$real = realpath($target);
if ($real === false || strpos($real, $publicDir) !== 0 || !is_file($real)) {
    http_response_code(404);
    echo 'Página não encontrada.';
    exit;
}

// Run the target script
require $real;
