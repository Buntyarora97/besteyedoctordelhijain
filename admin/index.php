<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/app/config/config.php';
require_once dirname(__DIR__) . '/app/core/Database.php';
require_once dirname(__DIR__) . '/app/core/helpers.php';
require_once dirname(__DIR__) . '/app/core/Csrf.php';

session_name(SESSION_NAME); session_start();
$pdo = Database::pdo();
$base = '/' . ADMIN_PATH;
$u = strtok($_SERVER['REQUEST_URI'], '?');
$path = preg_replace('#^' . preg_quote($base, '#') . '#', '', $u) ?: '/';
$msg = '';

// ---------- LOGIN (with lockout) ----------
if (!isset($_SESSION['admin_id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $path === '/login') {
        Csrf::check();
        $email = trim($_POST['email'] ?? ''); $pass = (string)($_POST['password'] ?? '');
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $fails = $pdo->prepare("SELECT COUNT(*) FROM admin_login_attempts WHERE email=? AND success=0 AND created_at > (NOW() - INTERVAL 15 MINUTE)");
        $fails->execute([$email]);
        if ((int)$fails->fetchColumn() >= 5) { $msg = 'Too many attempts. Try again after 15 minutes.'; }
        else {
            $st = $pdo->prepare("SELECT * FROM admins WHERE email=? AND status='active' AND deleted_at IS NULL");
            $st->execute([$email]); $a = $st->fetch();
            if ($a && password_verify($pass, $a['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id'] = $a['id']; $_SESSION['admin_role'] = $a['role_id'];
                $pdo->prepare('UPDATE admins SET last_login_at=NOW() WHERE id=?')->execute([$a['id']]);
                $pdo->prepare('INSERT INTO admin_login_attempts (email,ip,success) VALUES (?,?,1)')->execute([$email,$ip]);
                audit('login', 'Admin logged in', $a['id']);
                header('Location: ' . $base); exit;
            }
            $pdo->prepare('INSERT INTO admin_login_attempts (email,ip,success) VALUES (?,?,0)')->execute([$email,$ip]);
            $msg = 'Invalid credentials.';
        }
    }
    ?>
    <!doctype html><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Login</title><link rel="stylesheet" href="/public/assets/css/style.css">
    <body class="admin-login"><form method="post" action="<?= $base ?>/login" class="narrow-card form">
    <h1>Site Admin</h1><?php if ($msg): ?><p class="error"><?= e($msg) ?></p><?php endif; ?>
    <?= Csrf::field() ?>
    <label>Email <input type="email" name="email" required autocomplete="username"></label>
    <label>Password <input type="password" name="password" required autocomplete="current-password"></label>
    <button class="btn btn-primary">Sign in</button>
    <p class="microcopy">Admin path is configurable in app/config/config.php (ADMIN_PATH).</p></form></body>
    <?php exit;
}

$adminId = (int)$_SESSION['admin_id'];

if ($path === '/logout') { audit('logout', '', $adminId); session_destroy(); header('Location: ' . $base); exit; }

// ---------- POST actions ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Csrf::check();
    if ($path === '/appointment-status') {
        $pdo->prepare('UPDATE appointments SET status=?, admin_note=? WHERE id=?')
            ->execute([$_POST['status'], trim($_POST['note'] ?? ''), (int)$_POST['id']]);
        $pdo->prepare('INSERT INTO appointment_notes (appointment_id,admin_id,note) VALUES (?,?,?)')
            ->execute([(int)$_POST['id'], $adminId, trim($_POST['note'] ?? '')]);
        audit('appointment.status', 'ID ' . (int)$_POST['id'] . ' -> ' . $_POST['status'], $adminId);
    }
    if ($path === '/enquiry-status') {
        $pdo->prepare('UPDATE enquiries SET status=? WHERE id=?')->execute([$_POST['status'], (int)$_POST['id']]);
        audit('enquiry.status', 'ID ' . (int)$_POST['id'], $adminId);
    }
    if ($path === '/so-status') {
        $pdo->prepare('UPDATE second_opinion_requests SET status=? WHERE id=?')->execute([$_POST['status'], (int)$_POST['id']]);
        audit('second_opinion.status', 'ID ' . (int)$_POST['id'], $adminId);
    }
    if ($path === '/doctor-toggle') {
        $pdo->prepare("UPDATE doctors SET status = IF(status='published','draft','published') WHERE id=?")->execute([(int)$_POST['id']]);
        audit('doctor.toggle', 'ID ' . (int)$_POST['id'], $adminId);
    }
    if ($path === '/faq-add' && $_SESSION['admin_role'] <= 2) {
        $pdo->prepare('INSERT INTO faqs (question,answer,sort_order,status) VALUES (?,?,0,?)')
            ->execute([trim($_POST['question']), trim($_POST['answer']), $_POST['status'] ?? 'draft']);
        audit('faq.add', mb_substr($_POST['question'], 0, 60), $adminId);
    }
    if ($path === '/setting' && $_SESSION['admin_role'] == 1 && !in_array(($_POST['skey'] ?? ''), ['hospital_phone', 'hospital_address', 'hospital_email'], true)) {
        $pdo->prepare('INSERT INTO site_settings (skey,svalue,verified) VALUES (?,?,?)
            ON DUPLICATE KEY UPDATE svalue=VALUES(svalue), verified=VALUES(verified)')
            ->execute([$_POST['skey'], trim($_POST['svalue']), (int)!empty($_POST['verified'])]);
        audit('setting.update', $_POST['skey'], $adminId);
    }
    header('Location: ' . $base . ($_GET['to'] ?? '')); exit;
}

// ---------- CSV export (Super Admin) ----------
if ($path === '/export' && $_SESSION['admin_role'] == 1) {
    audit('export', ($_GET['t'] ?? '') . ' CSV', $adminId);
    header('Content-Type: text/csv'); header('Content-Disposition: attachment; filename=' . preg_replace('/[^a-z_]/','',$_GET['t'] ?? 'export') . '.csv');
    $out = fopen('php://output', 'w');
    if (($_GET['t'] ?? '') === 'appointments') {
        fputcsv($out, ['ref','name','phone','concern','date','status','created']);
        foreach ($pdo->query('SELECT ref_id,patient_name,phone,concern,preferred_date,status,created_at FROM appointments ORDER BY created_at DESC') as $r) fputcsv($out, $r);
    }
    exit;
}

$h = fn(string $t) => "<h1>" . e($t) . "</h1>";
?>
<!doctype html><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin — besteyedoctordelhi</title><link rel="stylesheet" href="/public/assets/css/style.css">
<body class="admin">
<nav class="admin-nav">
  <a href="<?= $base ?>">Dashboard</a>
  <a href="<?= $base ?>/appointments">Appointments</a>
  <a href="<?= $base ?>/enquiries">Enquiries</a>
  <a href="<?= $base ?>/second-opinions">Second Opinions</a>
  <a href="<?= $base ?>/doctors">Doctors</a>
  <a href="<?= $base ?>/faqs">FAQs</a>
  <?php if ($_SESSION['admin_role'] == 1): ?>
    <a href="<?= $base ?>/settings">Settings &amp; Verification</a>
    <a href="<?= $base ?>/audit">Audit Log</a>
  <?php endif; ?>
  <a href="<?= $base ?>/logout">Logout</a>
</nav>
<main class="admin-main">
<?php
if ($path === '/' || $path === ''):
    echo $h('Dashboard');
    $c = fn($sql) => (int)$pdo->query($sql)->fetchColumn();
    echo '<div class="stat-grid">
      <div class="stat"><strong>'.$c("SELECT COUNT(*) FROM appointments WHERE status='new'").'</strong><span>New appointments</span></div>
      <div class="stat"><strong>'.$c("SELECT COUNT(*) FROM enquiries WHERE status='new'").'</strong><span>New enquiries</span></div>
      <div class="stat"><strong>'.$c("SELECT COUNT(*) FROM second_opinion_requests WHERE status='new'").'</strong><span>Second opinions</span></div>
      <div class="stat"><strong>'.$c("SELECT COUNT(*) FROM faqs WHERE status='draft'").'</strong><span>FAQs in draft</span></div>
    </div>';
    echo $h('Launch verification gate');
    echo '<p class="microcopy">Anything marked PENDING must be verified before public launch. Unverified items stay draft/invisible.</p>';
    foreach ($pdo->query("SELECT skey,svalue,verified FROM site_settings ORDER BY verified,skey") as $s) {
        $settingValue = match ($s['skey']) {
            'hospital_phone' => implode(' · ', HOSPITAL_PHONES),
            'hospital_address' => HOSPITAL_ADDRESS,
            'hospital_email' => HOSPITAL_EMAIL,
            default => (string)$s['svalue'],
        };
        echo '<p class="verify-row '.($s['verified'] ? 'ok' : 'pending').'">'.($s['verified']?'[VERIFIED]':'[PENDING]').' <strong>'.e($s['skey']).'</strong>: '.e(mb_strimwidth($settingValue,0,90)).'</p>';
    }

elseif ($path === '/appointments'):
    echo $h('Appointments');
    if ($_SESSION['admin_role'] == 1) echo '<p><a class="btn btn-outline" href="'.$base.'/export?t=appointments">Export CSV</a></p>';
    echo '<table class="admin-table"><tr><th>Ref</th><th>Name</th><th>Phone</th><th>Concern</th><th>Date</th><th>Status</th><th>Update</th></tr>';
    foreach ($pdo->query('SELECT * FROM appointments ORDER BY created_at DESC LIMIT 200') as $r) {
        echo '<tr><td>'.e($r['ref_id']).'</td><td>'.e($r['patient_name']).'</td><td>'.e($r['phone']).'</td><td>'.e($r['concern']).'</td><td>'.e((string)$r['preferred_date']).'</td><td>'.e($r['status']).'</td>
        <td><form method="post" action="'.$base.'/appointment-status" class="inline">'.Csrf::field().'
        <input type="hidden" name="id" value="'.(int)$r['id'].'">
        <select name="status">'.implode('', array_map(fn($s)=>"<option".($r['status']===$s?' selected':'').">$s</option>",['new','contacted','confirmed','completed','cancelled'])).'</select>
        <input name="note" placeholder="note"><button class="btn btn-small">Save</button></form></td></tr>';
    }
    echo '</table>';

elseif ($path === '/enquiries'):
    echo $h('Enquiries');
    foreach ($pdo->query('SELECT * FROM enquiries ORDER BY created_at DESC LIMIT 100') as $r) {
        echo '<div class="card"><strong>'.e($r['ref_id']).' — '.e($r['name']).'</strong> ('.e($r['phone']).') — '.e($r['subject']).'<p>'.e($r['message']).'</p>
        <form method="post" action="'.$base.'/enquiry-status" class="inline">'.Csrf::field().'<input type="hidden" name="id" value="'.(int)$r['id'].'">
        <select name="status">'.implode('', array_map(fn($s)=>"<option".($r['status']===$s?' selected':'').">$s</option>",['new','replied','closed'])).'</select>
        <button class="btn btn-small">Save</button></form></div>';
    }

elseif ($path === '/second-opinions'):
    echo $h('Second Opinion Requests');
    echo '<p class="microcopy">Reports live in storage/uploads/private with random names — download via server only, never public URLs. Do not email attachments.</p>';
    foreach ($pdo->query('SELECT * FROM second_opinion_requests ORDER BY created_at DESC LIMIT 100') as $r) {
        echo '<div class="card"><strong>'.e($r['ref_id']).' — '.e($r['name']).'</strong> ('.e($r['phone']).') — status: '.e($r['status']);
        echo '<p>'.e($r['current_diagnosis']).'</p><p>'.e($r['question']).'</p>';
        echo $r['file_path'] ? '<p>Report on file: '.e($r['file_orig']).'</p>' : '';
        echo '<form method="post" action="'.$base.'/so-status" class="inline">'.Csrf::field().'<input type="hidden" name="id" value="'.(int)$r['id'].'">
        <select name="status">'.implode('', array_map(fn($s)=>"<option".($r['status']===$s?' selected':'').">$s</option>",['new','in_review','answered','closed'])).'</select>
        <button class="btn btn-small">Save</button></form></div>';
    }

elseif ($path === '/doctors'):
    echo $h('Doctors');
    foreach ($pdo->query('SELECT id,name,designation,status,qualifications_verified FROM doctors ORDER BY sort_order') as $d) {
        echo '<div class="card inline-row"><strong>'.e($d['name']).'</strong> — '.e((string)$d['designation']).
             ' — status: '.$d['status'].' — credentials '.($d['qualifications_verified']?'VERIFIED':'UNVERIFIED').
             ' <form method="post" action="'.$base.'/doctor-toggle" class="inline">'.Csrf::field().'
             <input type="hidden" name="id" value="'.(int)$d['id'].'"><button class="btn btn-small">Toggle publish</button></form></div>';
    }

elseif ($path === '/faqs'):
    echo $h('FAQs');
    foreach ($pdo->query('SELECT id,question,status FROM faqs ORDER BY sort_order') as $f)
        echo '<p>['.e($f['status']).'] '.e($f['question']).'</p>';
    echo '<form method="post" action="'.$base.'/faq-add" class="form narrow">'.Csrf::field().'
      <label>Question <input name="question" required></label>
      <label>Answer <textarea name="answer" rows="4" required></textarea></label>
      <label>Status <select name="status"><option>draft</option><option>published</option></select></label>
      <button class="btn btn-primary">Add FAQ</button></form>';

elseif ($path === '/settings' && $_SESSION['admin_role'] == 1):
    echo $h('Settings & Verification Flags');
    foreach ($pdo->query('SELECT * FROM site_settings') as $s) {
        if (in_array($s['skey'], ['hospital_phone', 'hospital_address', 'hospital_email'], true)) {
            $publicContact = match ($s['skey']) {
                'hospital_phone' => implode(' · ', HOSPITAL_PHONES),
                'hospital_address' => HOSPITAL_ADDRESS,
                'hospital_email' => HOSPITAL_EMAIL,
            };
            echo '<p class="verify-row ok"><strong>Public '.e($s['skey']).'</strong>: '.e($publicContact).' (managed in app/config/config.php)</p>';
            continue;
        }
        echo '<form method="post" action="'.$base.'/setting?to=/settings" class="inline setting-row">'.Csrf::field().'
          <input type="hidden" name="skey" value="'.e($s['skey']).'">
          <strong>'.e($s['skey']).'</strong>
          <input name="svalue" value="'.e((string)$s['svalue']).'">
          <label><input type="checkbox" name="verified" '.($s['verified']?'checked':'').'> verified</label>
          <button class="btn btn-small">Save</button></form>';
    }

elseif ($path === '/audit' && $_SESSION['admin_role'] == 1):
    echo $h('Audit Log');
    echo '<table class="admin-table"><tr><th>Time</th><th>Admin</th><th>Action</th><th>Detail</th><th>IP</th></tr>';
    foreach ($pdo->query('SELECT a.*,ad.name FROM audit_logs a LEFT JOIN admins ad ON ad.id=a.admin_id ORDER BY a.id DESC LIMIT 300') as $r)
        echo '<tr><td>'.e($r['created_at']).'</td><td>'.e($r['name'] ?? '-').'</td><td>'.e($r['action']).'</td><td>'.e((string)$r['detail']).'</td><td>'.e((string)$r['ip']).'</td></tr>';
    echo '</table>';

else: echo '<h1>Not found</h1>';
endif;
?>
</main></body>
