<?php
// Local Replit preview router. Shared hosting continues to use .htaccess + index.php.
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = rawurldecode($path);
$file = __DIR__ . $path;

// Keep the physical admin script private; use the configured, non-obvious path instead.
if ($path === '/admin' || str_starts_with($path, '/admin/')) {
    require __DIR__ . '/index.php';
    return true;
}

if ($path !== '/' && is_file($file)) {
    return false;
}

require __DIR__ . '/index.php';