# Deployment Guide — cPanel shared hosting

1. **PHP/MySQL**: select PHP 8.1+ in cPanel MultiPHP Manager; MySQL 8 (MariaDB 10.5+ also works).
2. **Database**: cPanel → MySQL Databases → create DB `besteye_db`, user `besteye_user`,
   strong password, assign ALL PRIVILEGES (or least-privilege: SELECT/INSERT/UPDATE/DELETE).
   phpMyAdmin → import `database/schema.sql`, then `database/seed.sql`.
3. **Config**: edit `app/config/config.php`. Never commit real credentials; this file is already
   blocked from web access by `.htaccess`.
4. **Upload**: upload the whole project into `public_html`. Document root stays `public_html`;
   sensitive folders (`app`, `storage`, `database`) are blocked by rewrite rules + their own `.htaccess`.
5. **Permissions**: folders 755, files 644. `storage/logs` writable by the PHP user (755 is enough on suPHP/LSAPI). Never 777.
6. **Admin password**: `php -r "echo password_hash('StrongPassHere', PASSWORD_DEFAULT);"` →
   paste into `admins.password_hash` via phpMyAdmin. Change `ADMIN_PATH`.
7. **SMTP**: configure `SMTP_*` in config. On cPanel you can use `mail()` for launch and switch to
   authenticated SMTP (PHPMailer) afterwards; `sendMail()` is the single choke point to replace.
8. **SSL**: cPanel → SSL/TLS → force HTTPS (root `.htaccess` also redirects).
9. **Cron**: optional — daily `DELETE FROM rate_limits WHERE created_at < NOW() - INTERVAL 1 DAY;`
   and a monthly email reminder for `articles.next_review_at` due dates.
10. **Sitemap/robots**: verify `https://yourdomain.com/sitemap.xml.php` and `/robots.txt` load.
11. **Search Console / GA4**: add verification meta tags in `views/layouts/main.php` (no IDs hard-coded).
12. **Backup/rollback**: weekly cPanel full backup + export DB before any change; test restore once.

## Security checklist (pre-launch)
- [ ] ADMIN_PATH changed from default; admin password is a real password_hash
- [ ] DB credentials strong; config not in any public repo
- [ ] HTTPS on; headers active (check response headers)
- [ ] `app/`, `storage/`, `database/` return 403 when accessed directly
- [ ] Forms: CSRF token present, honeypot hidden, rate limiting table filling
- [ ] Second-opinion uploads: only PDF/JPG/PNG, 5MB max, random filenames, `storage/uploads/private` = 403
- [ ] Admin lockout works (5 failed logins → 15 min block)
- [ ] Error display off in production (APP_ENV=production)
- [ ] Public phone contacts match the approved numbers in `app/config/config.php`

## Rollback
Restore the cPanel backup taken before deploy; re-import the pre-change DB export.
