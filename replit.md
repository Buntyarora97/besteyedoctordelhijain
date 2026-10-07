# besteyedoctordelhi.com

## Local preview

The Replit preview uses the `Start application` workflow:

```bash
php -S 0.0.0.0:5000 dev-router.php
```

`dev-router.php` serves static assets during local preview and forwards clean
URLs to `index.php`. Shared hosting should continue to use the existing
`.htaccess` and `index.php` front controller.

## Shared-hosting setup

1. Use PHP 8.1+ and MySQL 8 (MariaDB 10.5+ is also supported).
2. Import `database/schema.sql`, then `database/seed.sql`.
3. Set DB credentials, `APP_URL`, `ADMIN_PATH`, and SMTP values in
   `app/config/config.php` without committing real secrets.
4. Change the default admin path and create a password hash with
   `php -r "echo password_hash('YourStrongPassword', PASSWORD_DEFAULT), PHP_EOL;"`.
5. Upload the project into `public_html`, keep `storage/logs` writable, enable
   HTTPS, and verify `sitemap.xml.php` and `robots.txt`.

The supplied phone number, WhatsApp number, clinic timings, exact map pin,
social handles, doctor credentials, equipment, testimonials, and review
ratings remain verification-controlled. Unverified values are presented as
pending rather than silently invented.

## Approved public phone contacts

Only these hospital phone numbers may appear as public contact numbers:
011 4378 4377, 09643536373, and 9643 900 900. The list in
`app/config/config.php` is the source of truth; do not add other hospital
phone numbers to public pages or contact links.

The approved public hospital address is AG 152, Shalimar Bagh, Delhi 110088.