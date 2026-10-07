<?php
declare(strict_types=1);

final class Csrf
{
    public static function token(): string {
        if (session_status() !== PHP_SESSION_ACTIVE) { session_name(SESSION_NAME); session_start(); }
        if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
        return $_SESSION['csrf'];
    }

    public static function field(): string {
        return '<input type="hidden" name="csrf" value="' . self::token() . '">';
    }

    public static function check(): void {
        if (session_status() !== PHP_SESSION_ACTIVE) { session_name(SESSION_NAME); session_start(); }
        $t = $_POST['csrf'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
        if (!is_string($t) || !hash_equals($_SESSION['csrf'] ?? '', $t)) {
            http_response_code(419);
            exit('Invalid session token. Please go back and try again.');
        }
    }
}
