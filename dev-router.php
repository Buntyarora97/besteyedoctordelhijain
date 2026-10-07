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

$publicRoot = realpath(__DIR__ . '/public');
$resolvedFile = realpath($file);
if ($path === '/sitemap.xml') {
    require __DIR__ . '/sitemap.xml.php';
    return true;
}

$isPublicAsset = str_starts_with($path, '/public/')
    && $publicRoot !== false
    && $resolvedFile !== false
    && str_starts_with($resolvedFile, $publicRoot . DIRECTORY_SEPARATOR)
    && is_file($resolvedFile);
$isApprovedRootFile = in_array($path, ['/index.php', '/robots.txt', '/sitemap.xml.php'], true)
    && is_file($file);

if ($path !== '/' && ($isPublicAsset || $isApprovedRootFile)) {
    return false;
}

require __DIR__ . '/index.php';
return true;