<?php
// besteyedoctordelhi.com - configuration
// DO NOT commit real credentials to public repos. On cPanel, keep this file
// outside public_html or protect via .htaccess (already blocked).

define('DB_HOST', 'localhost');
define('DB_NAME', 'besteye_db');
define('DB_USER', 'besteye_user');
define('DB_PASS', 'CHANGE_ME_STRONG_PASSWORD');
define('DB_CHARSET', 'utf8mb4');

define('APP_ENV', 'production');          // 'development' shows errors locally only
define('APP_URL', 'https://besteyedoctordelhi.com');
define('ADMIN_PATH', 'eye-admin-7f3k');   // non-obvious admin path - CHANGE THIS

define('SMTP_HOST', 'mail.jaineyehospitals.com');
define('SMTP_USER', 'info@jaineye.com');
define('SMTP_PASS', 'CHANGE_ME');
define('SMTP_PORT', 587);
define('ADMIN_EMAIL', 'info@jaineye.com');

define('HOSPITAL_NAME', 'Jain Eye Hospital & Laser Centre');
define('HOSPITAL_ADDRESS', 'AG 152, Shalimar Bagh, Delhi 110088');
define('HOSPITAL_PHONES', ['011 4378 4377', '09643536373', '9643 900 900']);
define('HOSPITAL_PHONE', HOSPITAL_PHONES[0]);
define('HOSPITAL_EMAIL', 'info@jaineye.com');

define('UPLOAD_MAX_BYTES', 5 * 1024 * 1024); // 5MB
define('SESSION_NAME', 'BEYDSESSID');

date_default_timezone_set('Asia/Kolkata');

if (APP_ENV === 'development') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    ini_set('error_log', dirname(__DIR__, 2) . '/storage/logs/php_error.log');
}
