<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/helpers.php';
require_once __DIR__ . '/../core/Csrf.php';
require_once __DIR__ . '/../core/RateLimit.php';

final class FormController
{
    public static function register(Router $r): void
    {
        $r->post('/book-appointment', function () { self::appointment(); });
        $r->post('/contact', function () { self::enquiry(); });
        $r->post('/second-opinion', function () { self::secondOpinion(); });
        $r->post('/api/finder', function () { self::finderApi(); });
        $r->get('/api/search', function () { self::searchApi(); });
    }

    // Concern keywords -> speciality label + route. NEVER outputs a diagnosis.
    private const URGENT_KEYWORDS = ['sudden vision loss','chemical','injury','severe pain','curtain','flashes','floaters shower','sudden'];

    private static function isUrgent(string $text): bool {
        $t = mb_strtolower($text);
        foreach (self::URGENT_KEYWORDS as $k) { if (mb_strpos($t, $k) !== false) return true; }
        return false;
    }

    // -------- Appointment --------
    private static function appointment(): void {
        Csrf::check();
        RateLimit::check('appointment', 5, 600);

        // honeypot
        if (!empty($_POST['website'])) redirect('/book-appointment?ok=1');

        $name  = trim($_POST['patient_name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $age   = trim($_POST['age_band'] ?? '');
        $docId = (int)($_POST['doctor_id'] ?? 0) ?: null;
        $concern = trim($_POST['concern'] ?? '');
        $date  = $_POST['preferred_date'] ?? null;
        $time  = trim($_POST['time_preference'] ?? '');
        $existing = !empty($_POST['existing_patient']) ? 1 : 0;
        $msg   = trim($_POST['message'] ?? '');
        $consent = !empty($_POST['consent']);

        $errors = [];
        if ($name === '' || mb_strlen($name) < 2) $errors[] = 'Please enter the patient name.';
        if (!preg_match('/^[0-9+\-\s]{8,16}$/', $phone)) $errors[] = 'Please enter a valid phone number.';
        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email or leave it blank.';
        if (!in_array($age, AGE_BANDS, true)) $errors[] = 'Please select an age band.';
        if (!$consent) $errors[] = 'Please accept the consent checkbox.';
        if ($errors) { flash('form_errors', implode(' ', $errors)); redirect('/book-appointment'); }

        $ref = refId('APT');
        $pdo = Database::pdo();
        $pdo->prepare('INSERT INTO appointments (ref_id,patient_name,age_band,phone,email,doctor_id,concern,preferred_date,time_preference,existing_patient,message,consent_given)
                       VALUES (?,?,?,?,?,?,?,?,?,?,?,?)')
            ->execute([$ref,$name,$age,$phone,$email,$docId,$concern,$date,$time,$existing,$msg,$consent]);
        $pdo->prepare('INSERT INTO consent_records (form_type,record_id,consent_text,ip) VALUES (?,?,?,?)')
            ->execute(['appointment',$pdo->lastInsertId(),'Consent to be contacted about this appointment request.',$_SERVER['REMOTE_ADDR'] ?? '']);

        sendMail(ADMIN_EMAIL, 'New appointment request ' . $ref,
            "Ref: $ref\nName: $name\nAge: $age\nPhone: $phone\nEmail: $email\nConcern: $concern\nPreferred: $date $time\nMessage: $msg");
        if ($email) sendMail($email, 'Your appointment request ' . $ref,
            "Dear $name,\n\nYour request has been received (Reference: $ref). The appointment is confirmed only after the hospital contacts you.\n\n— Jain Eye Hospital & Laser Centre, Delhi");

        redirect('/book-appointment?ok=' . $ref);
    }

    // -------- Enquiry --------
    private static function enquiry(): void {
        Csrf::check();
        RateLimit::check('enquiry', 5, 600);
        if (!empty($_POST['website'])) redirect('/contact?ok=1');

        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        $errors = [];
        if ($name === '') $errors[] = 'Please enter your name.';
        if (!preg_match('/^[0-9+\-\s]{8,16}$/', $phone)) $errors[] = 'Please enter a valid phone number.';
        if ($message === '') $errors[] = 'Please write a message.';
        if ($errors) { flash('form_errors', implode(' ', $errors)); redirect('/contact'); }

        $ref = refId('ENQ');
        $pdo = Database::pdo();
        $pdo->prepare('INSERT INTO enquiries (ref_id,name,phone,email,subject,message) VALUES (?,?,?,?,?,?)')
            ->execute([$ref,$name,$phone,$email,$subject,$message]);
        sendMail(ADMIN_EMAIL, 'New enquiry ' . $ref, "Name: $name\nPhone: $phone\nEmail: $email\nSubject: $subject\n\n$message");
        redirect('/contact?ok=' . $ref);
    }

    // -------- Second opinion (secure upload) --------
    private static function secondOpinion(): void {
        Csrf::check();
        RateLimit::check('second_opinion', 3, 600);
        if (!empty($_POST['website'])) redirect('/second-opinion?ok=1');

        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $diag = trim($_POST['current_diagnosis'] ?? '');
        $q = trim($_POST['question'] ?? '');
        $consent = !empty($_POST['consent']);

        $errors = [];
        if ($name === '') $errors[] = 'Please enter your name.';
        if (!preg_match('/^[0-9+\-\s]{8,16}$/', $phone)) $errors[] = 'Please enter a valid phone number.';
        if (!$consent) $errors[] = 'Consent is required to share your reports.';
        if ($errors) { flash('form_errors', implode(' ', $errors)); redirect('/second-opinion'); }

        $filePath = null; $fileOrig = null;
        if (!empty($_FILES['report']['name'])) {
            $f = $_FILES['report'];
            if ($f['size'] > UPLOAD_MAX_BYTES) { flash('form_errors', 'File must be under 5 MB.'); redirect('/second-opinion'); }
            $mime = mime_content_type($f['tmp_name']);
            $allowed = ['application/pdf' => 'pdf', 'image/jpeg' => 'jpg', 'image/png' => 'png'];
            if (!isset($allowed[$mime])) { flash('form_errors', 'Only PDF, JPG or PNG files are accepted.'); redirect('/second-opinion'); }
            $stored = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
            $dest = dirname(__DIR__, 2) . '/storage/uploads/private/' . $stored;
            if (!move_uploaded_file($f['tmp_name'], $dest)) { flash('form_errors', 'Upload failed, please try again.'); redirect('/second-opinion'); }
            chmod($dest, 0600);
            $filePath = $stored; $fileOrig = basename($f['name']);
            Database::pdo()->prepare('INSERT INTO uploads (orig_name,stored_name,mime,size,context) VALUES (?,?,?,?,?)')
                ->execute([$fileOrig,$stored,$mime,$f['size'],'second_opinion']);
        }

        $ref = refId('SO');
        $pdo = Database::pdo();
        $pdo->prepare('INSERT INTO second_opinion_requests (ref_id,name,phone,email,current_diagnosis,question,file_path,file_orig,consent_given) VALUES (?,?,?,?,?,?,?,?,?)')
            ->execute([$ref,$name,$phone,$email,$diag,$q,$filePath,$fileOrig,$consent]);
        $pdo->prepare('INSERT INTO consent_records (form_type,record_id,consent_text,ip) VALUES (?,?,?,?)')
            ->execute(['second_opinion',$pdo->lastInsertId(),'Consent to privately share reports for a second opinion.',$_SERVER['REMOTE_ADDR'] ?? '']);

        sendMail(ADMIN_EMAIL, 'Second opinion request ' . $ref, "Ref: $ref\nName: $name\nPhone: $phone\nDiagnosis: $diag\nQuestion: $q");
        redirect('/second-opinion?ok=' . $ref);
    }

    // -------- 5-step finder API (guidance only, never a diagnosis) --------
    private static function finderApi(): void {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $ageGroup = $input['age_group'] ?? 'adult';
        $concern  = mb_strtolower(trim($input['concern'] ?? ''));
        $onset    = $input['onset'] ?? 'gradual';
        $known    = trim($input['known'] ?? '');
        $text = $concern . ' ' . $known;

        if (self::isUrgent($text) || $onset === 'sudden') {
            echo json_encode([
                'urgent' => true,
                'message' => 'Because you mentioned a sudden or severe symptom, please call Jain Eye Hospital immediately or visit urgently. Sudden vision changes, chemical exposure, injury, severe pain, a curtain-like shadow or a sudden shower of floaters need same-day assessment.',
                'phone' => HOSPITAL_PHONE,
            ]);
            return;
        }

        // map concern text to speciality
        $map = [
            'retina' => ['retina','floater','flash','diabet','veil','curtain','macula'],
            'paediatric' => ['child','squint','baby','kid','lazy','premature','rop'],
            'refractive' => ['lasik','glasses removal','spectacle','refractive','power removal'],
            'cornea' => ['cornea','red eye','painful','ulcer','infection','injury'],
            'glaucoma' => ['glaucoma','pressure','optic'],
            'uveitis' => ['uveitis','inflammation'],
            'cataract' => ['cataract','cloudy'],
            'comprehensive' => ['check','blur','dry','watery','routine','headache'],
        ];
        $spec = 'comprehensive';
        foreach ($map as $k => $keys) {
            foreach ($keys as $kw) { if (mb_strpos($concern, $kw) !== false) { $spec = $k; break 2; } }
        }
        if ($ageGroup === 'child' && !in_array($spec, ['paediatric','retina'], true)) $spec = 'paediatric';

        try {
            $st = Database::pdo()->prepare(
                "SELECT d.slug,d.name,d.designation FROM doctors d
                 JOIN doctor_specialities ds ON ds.doctor_id=d.id
                 JOIN specialities s ON s.id=ds.speciality_id
                 WHERE s.slug=? AND d.status='published' AND d.deleted_at IS NULL LIMIT 4");
            $st->execute([$spec]);
            $docs = $st->fetchAll();
        } catch (Throwable $e) { $docs = []; }

        echo json_encode([
            'urgent' => false,
            'message' => 'A consultation with a ' . str_replace('-', ' ', $spec) . ' specialist may be appropriate. This guide does not diagnose your condition.',
            'doctors' => $docs,
            'bookUrl' => '/book-appointment',
        ]);
    }

    // -------- Global search API --------
    private static function searchApi(): void {
        header('Content-Type: application/json');
        $q = trim((string)($_GET['q'] ?? ''));
        if (mb_strlen($q) < 2) { echo json_encode(['results' => []]); return; }
        $like = '%' . $q . '%';
        $out = [];
        try {
            $pdo = Database::pdo();
            foreach ([
                ['Doctor','doctors','name',"/doctors/",'published'],
                ['Concern','conditions','name',"/eye-concerns/",'published'],
                ['Treatment','treatments','name',"/eye-care/",'published'],
                ['FAQ','faqs','question',"/faqs",'published'],
                ['Article','articles','title',"/articles/",'published'],
            ] as [$type,$table,$col,$base,$status]) {
                $st = $pdo->prepare("SELECT $col AS t, slug FROM $table WHERE $col LIKE ? AND status=? LIMIT 5");
                $st->execute([$like,$status]);
                foreach ($st->fetchAll() as $row) {
                    $out[] = ['type' => $type, 'title' => $row['t'], 'url' => $base . ($row['slug'] ?? '')];
                }
            }
        } catch (Throwable $e) {}
        echo json_encode(['results' => array_slice($out, 0, 12)]);
    }
}
