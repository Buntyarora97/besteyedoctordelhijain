<?php
declare(strict_types=1);

final class RateLimit
{
    public static function check(string $bucket, int $max, int $windowSec): void {
        $pdo = Database::pdo();
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $pdo->prepare('DELETE FROM rate_limits WHERE bucket=? AND ip=? AND created_at < (NOW() - INTERVAL ? SECOND)')
            ->execute([$bucket, $ip, $windowSec]);
        $c = $pdo->prepare('SELECT COUNT(*) FROM rate_limits WHERE bucket=? AND ip=?');
        $c->execute([$bucket, $ip]);
        if ((int)$c->fetchColumn() >= $max) {
            http_response_code(429);
            exit('Too many requests. Please wait a few minutes and try again.');
        }
        $pdo->prepare('INSERT INTO rate_limits (bucket, ip, created_at) VALUES (?,?,NOW())')->execute([$bucket, $ip]);
    }
}
