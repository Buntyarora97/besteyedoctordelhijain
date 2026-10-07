<?php
declare(strict_types=1);

final class Router
{
    private array $routes = [];

    public function get(string $pattern, callable $handler): void {
        $this->routes['GET'][$pattern] = $handler;
    }

    public function post(string $pattern, callable $handler): void {
        $this->routes['POST'][$pattern] = $handler;
    }

    public function dispatch(string $method, string $uri): void {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $path = rtrim($path, '/') ?: '/';
        foreach ($this->routes[$method] ?? [] as $pattern => $handler) {
            $regex = '#^' . preg_replace('#\{([a-z_]+)\}#', '(?P<$1>[^/]+)', $pattern) . '$#';
            if (preg_match($regex, $path, $m)) {
                $params = array_filter($m, 'is_string', ARRAY_FILTER_USE_KEY);
                call_user_func_array($handler, $params);
                return;
            }
        }
        http_response_code(404);
        require dirname(__DIR__, 2) . '/views/errors/404.php';
    }
}
