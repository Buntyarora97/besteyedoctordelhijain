<?php
declare(strict_types=1);

function e(?string $s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function url(string $path = ''): string {
    return APP_URL . '/' . ltrim($path, '/');
}

function redirect(string $path): void {
    header('Location: ' . (str_starts_with($path, 'http') ? $path : url($path)));
    exit;
}

function flash(string $key, ?string $val = null) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_name(SESSION_NAME);
        session_start();
    }
    if ($val !== null) { $_SESSION['flash'][$key] = $val; return null; }
    $v = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $v;
}

function audit(string $action, string $detail = '', ?int $adminId = null): void {
    try {
        $pdo = Database::pdo();
        $pdo->prepare('INSERT INTO audit_logs (admin_id, action, detail, ip, created_at) VALUES (?,?,?,?,NOW())')
            ->execute([$adminId, $action, mb_substr($detail, 0, 500), $_SERVER['REMOTE_ADDR'] ?? '']);
    } catch (Throwable $e) { error_log('audit failed: ' . $e->getMessage()); }
}

function sendMail(string $to, string $subject, string $body): bool {
    $headers = "From: " . SMTP_USER . "\r\nReply-To: " . SMTP_USER . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    // For production SMTP auth, install/enable PHPMailer or use cPanel SMTP relay.
    return @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, $headers);
}

function refId(string $prefix): string {
    return $prefix . '-' . date('ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));
}

function setting(string $key, string $default = ''): string {
    static $cache = [];
    if (!array_key_exists($key, $cache)) {
        try {
            $st = Database::pdo()->prepare('SELECT svalue FROM site_settings WHERE skey = ?');
            $st->execute([$key]);
            $cache[$key] = $st->fetchColumn() ?: $default;
        } catch (Throwable $e) { $cache[$key] = $default; }
    }
    return $cache[$key];
}

function verified_only(array $row, string $field, string $fallback = ''): string {
    return (!empty($row[$field . '_verified'])) ? (string)$row[$field] : $fallback;
}
