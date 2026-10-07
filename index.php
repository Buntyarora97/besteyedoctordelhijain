<?php
declare(strict_types=1);

require_once __DIR__ . '/app/config/config.php';

$requestPath = rtrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/') ?: '/';
$adminPrefix = '/' . trim(ADMIN_PATH, '/');
if ($adminPrefix !== '/' && ($requestPath === $adminPrefix || str_starts_with($requestPath, $adminPrefix . '/'))) {
    require __DIR__ . '/admin/index.php';
    exit;
}
if ($requestPath === '/admin' || str_starts_with($requestPath, '/admin/')) {
    http_response_code(404);
    require __DIR__ . '/views/errors/404.php';
    exit;
}

require_once __DIR__ . '/app/core/Database.php';
require_once __DIR__ . '/app/core/helpers.php';
require_once __DIR__ . '/app/core/Csrf.php';
require_once __DIR__ . '/app/core/RateLimit.php';
require_once __DIR__ . '/app/core/Router.php';
require_once __DIR__ . '/app/controllers/PageController.php';
require_once __DIR__ . '/app/controllers/FormController.php';
require_once __DIR__ . '/app/data/content.php';

session_name(SESSION_NAME);
session_start();

$router = new Router();
PageController::register($router);
FormController::register($router);

$route = $_GET['route'] ?? '';
if ($route === '404') { http_response_code(404); require __DIR__ . '/views/errors/404.php'; exit; }
if ($route === '403') { http_response_code(403); require __DIR__ . '/views/errors/403.php'; exit; }
if ($route === '500') { http_response_code(500); require __DIR__ . '/views/errors/500.php'; exit; }

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
