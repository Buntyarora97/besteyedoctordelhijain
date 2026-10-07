# besteyedoctordelhi.com — Core PHP 8 + MySQL 8

Patient-first eye-specialist discovery website associated with Jain Eye Hospital & Laser Centre, Delhi.
Core PHP 8.1+, PDO, MySQL 8, semantic HTML5, vanilla CSS/JS. No frameworks. Runs on cPanel shared hosting.

## Install (5 minutes)
1. Create a MySQL DB + user in cPanel; import `database/schema.sql` then `database/seed.sql` (phpMyAdmin).
2. Edit `app/config/config.php`: DB credentials, `APP_URL`, `ADMIN_PATH` (change to your own secret path), SMTP.
3. Set the admin password:
   `php -r "echo password_hash('YourStrongPassword', PASSWORD_DEFAULT), PHP_EOL;"`
   Put the output hash into the `admins` row (update via phpMyAdmin or re-import seed with your hash).
4. Upload all files to `public_html`. `app/`, `storage/`, `database/` are blocked by root `.htaccess`.
5. Ensure `storage/logs` is writable (755). Never 777.
6. Enable SSL (HTTPS redirect already in `.htaccess`).

## Admin
URL: `https://yourdomain.com/<ADMIN_PATH>/` (default configured: `eye-admin-7f3k` — CHANGE IT).
Roles: Super Admin (all + settings/audit/export), Content Editor (content), Enquiry Manager (leads).

## Verification gate (important)
Everything unverified stays draft/invisible: doctor profiles (seeded as draft), phone number,
WhatsApp, timings, equipment names, prices, testimonials, insurance partners. Verify in
Admin → Settings & Verification, then publish from Admin → Doctors.

## Structure
- `index.php` front controller + `Router`
- `app/config`, `app/core`, `app/controllers`, `app/data` (all long-form content)
- `views/layouts`, `views/pages`, `views/errors`
- `admin/index.php` single-file secure admin
- `public/assets` CSS/JS/SVG
- `storage/logs`, `storage/uploads/private` (denied via .htaccess)
- `database/schema.sql`, `database/seed.sql`
