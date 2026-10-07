<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/helpers.php';

final class PageController
{
    private static array $concerns = [];
    private static array $treatments = [];
    private static array $guides = [];

    private static function load(): void {
        if (!self::$concerns) { self::$concerns = concern_pages(); self::$treatments = treatment_pages(); self::$guides = guide_pages(); }
    }

    public static function sitemapPaths(): array {
        self::load();
        $out = [];
        $out[] = 'eye-concerns';
        foreach (array_keys(self::$concerns) as $s) $out[] = 'eye-concerns/' . $s;
        foreach (array_keys(self::$treatments) as $s) $out[] = 'eye-care/' . $s;
        foreach (array_keys(self::$guides) as $s) $out[] = 'patient-guide/' . $s;
        try {
            $publishedDoctors = Database::pdo()->query(
                "SELECT slug FROM doctors WHERE status='published' AND deleted_at IS NULL ORDER BY sort_order"
            )->fetchAll(PDO::FETCH_COLUMN);
            foreach ($publishedDoctors as $slug) $out[] = 'doctors/' . rawurlencode((string)$slug);
        } catch (Throwable $e) {
            // Keep the static sitemap available until the hospital database is configured.
        }
        return $out;
    }

    public static function register(Router $r): void
    {
        $r->get('/', function () { self::home(); });
        $r->get('/about', function () { self::about(); });
        $r->get('/doctors', function () { self::doctorsIndex(); });
        $r->get('/doctors/{slug}', function ($slug) { self::doctorProfile($slug); });
        $r->get('/find-an-eye-doctor', function () { self::finder(); });
        $r->get('/book-appointment', function () { self::booking(); });
        $r->get('/second-opinion', function () { self::secondOpinion(); });
        $r->get('/contact', function () { self::contact(); });
        $r->get('/location/adarsh-nagar-delhi', function () { self::location(); });
        $r->get('/why-choose-an-eye-specialist', function () { self::staticPage('why-choose-an-eye-specialist'); });
        $r->get('/faqs', function () { self::faqs(); });
        $r->get('/eye-concerns', function () { self::concernsIndex(); });
        $r->get('/articles', function () { self::articles(); });
        $r->get('/articles/{slug}', function ($slug) { self::article($slug); });
        $r->get('/videos', function () { self::staticPage('videos'); });
        $r->get('/gallery', function () { self::staticPage('gallery'); });
        $r->get('/eye-concerns/{slug}', function ($slug) { self::longform('concern', $slug); });
        $r->get('/eye-care/{slug}', function ($slug) { self::longform('treatment', $slug); });
        $r->get('/patient-guide/{slug}', function ($slug) { self::longform('guide', $slug); });
        foreach (['privacy-policy','terms','medical-disclaimer','accessibility','sitemap'] as $legal) {
            $r->get('/' . $legal, function () use ($legal) { self::legal($legal); });
        }
    }

    private static function data(string $what): array {
        self::load();
        return match($what) { 'concern' => self::$concerns, 'treatment' => self::$treatments, 'guide' => self::$guides, default => [] };
    }

    private static function editorialGuides(): array {
        return [
            [
                'slug' => 'blurry-vision',
                'link' => '/eye-concerns/blurry-vision',
                'cat' => 'Eye symptoms',
                'title' => 'Blurry vision: what to ask at an eye examination',
                'excerpt' => 'Learn why blur can have different causes, what a clinician may check, and which symptoms should not wait.',
                'image' => '/public/assets/images/clinical/neha-mohan-4.webp',
                'image_alt' => 'An ophthalmologist examining a patient with a slit lamp',
            ],
            [
                'slug' => 'cataract',
                'link' => '/eye-care/cataract',
                'cat' => 'Cataract care',
                'title' => 'Understand cataract options before your visit',
                'excerpt' => 'A plain-language guide to when cataract surgery is discussed, lens choices and questions for your clinician.',
                'image' => '/public/assets/images/clinical/precision-ophthalmic-surgery-in-theatre.webp',
                'image_alt' => 'Ophthalmic surgery under an operating microscope',
            ],
            [
                'slug' => 'first-visit',
                'link' => '/patient-guide/first-visit',
                'cat' => 'Patient guide',
                'title' => 'How to prepare for your first eye consultation',
                'excerpt' => 'A practical checklist for records, medicines, glasses and questions to bring to an eye-care appointment.',
                'image' => '/public/assets/images/clinical/hospital-pic-8.webp',
                'image_alt' => 'The hospital reception and patient desk',
            ],
        ];
    }

    private static function fallbackFaqs(): array {
        return [
            ['question' => 'Can this website diagnose an eye problem?', 'answer' => 'No. The guides explain common eye-care topics and help you prepare questions, but only an eye-care professional can assess your eyes and give personal advice.'],
            ['question' => 'How do I choose which eye specialist to see?', 'answer' => 'Start with the concern that brought you here. The specialist finder and concern guides explain which area of eye care may be a useful starting point; the final choice depends on an examination.'],
            ['question' => 'What should I bring to an eye consultation?', 'answer' => 'Bring your current glasses or contact-lens details, previous prescriptions or test reports, and a list of medicines you use. Do not stop prescribed medicines unless your clinician advises you to.'],
            ['question' => 'Is an appointment request automatically confirmed?', 'answer' => 'No. A request is received first; the hospital confirms the appointment after contacting you. Please confirm current timings before travelling.'],
            ['question' => 'Can I request a second opinion?', 'answer' => 'Yes. The second-opinion form lets you share your question and relevant reports with consent. Do not use an online form for an emergency or delay urgent assessment.'],
            ['question' => 'When should I seek urgent eye care?', 'answer' => 'Sudden vision loss, a curtain-like shadow, new flashes with many floaters, severe eye pain, chemical exposure or an eye injury may need urgent assessment. Contact the hospital or go to the nearest emergency service.'],
        ];
    }

    private static function seoTitle(string $path, string $title, array $vars): string {
        $fixed = [
            '/' => 'Eye Specialist in Delhi | Jain Eye Hospital',
            '/about' => 'About Jain Eye Hospital & Eye Care Guidance',
            '/find-an-eye-doctor' => 'Find an Eye Doctor in Delhi | Jain Eye',
            '/doctors' => 'Eye Specialists in Delhi | Jain Eye Hospital',
            '/why-choose-an-eye-specialist' => 'Why Choose an Eye Specialist? | Jain Eye',
            '/eye-concerns' => 'Eye Concerns & Symptoms Guide | Delhi',
            '/second-opinion' => 'Second Opinion for Eye Care | Jain Eye Delhi',
            '/book-appointment' => 'Book an Eye Consultation in Delhi | Jain Eye',
            '/contact' => 'Contact Jain Eye Hospital | Shalimar Bagh, Delhi',
            '/location/adarsh-nagar-delhi' => 'Eye Hospital Location in Shalimar Bagh, Delhi',
            '/faqs' => 'Eye Care FAQs | Jain Eye Hospital Delhi',
            '/articles' => 'Eye Care Knowledge Hub | Jain Eye Hospital',
            '/videos' => 'Eye Care Videos | Jain Eye Hospital Delhi',
            '/gallery' => 'Jain Eye Hospital Gallery | Delhi',
            '/privacy-policy' => 'Privacy Policy | Jain Eye Hospital Delhi',
            '/terms' => 'Website Terms | Jain Eye Hospital Delhi',
            '/medical-disclaimer' => 'Medical Disclaimer | Jain Eye Hospital Delhi',
            '/accessibility' => 'Accessibility | Jain Eye Hospital Delhi',
            '/sitemap' => 'Website Sitemap | Jain Eye Hospital Delhi',
        ];
        if (isset($fixed[$path])) return $fixed[$path];

        if (str_starts_with($path, '/eye-concerns/')) {
            $topic = self::titleTopic($vars['page']['title'] ?? $title, basename($path));
            return self::fitTitle($topic . ': Eye Symptoms Guide | Delhi');
        }
        if (str_starts_with($path, '/eye-care/')) {
            $topic = self::titleTopic($vars['page']['title'] ?? $title, basename($path));
            return self::fitTitle($topic . ' | Eye Care, Delhi');
        }
        if (str_starts_with($path, '/patient-guide/')) {
            $topic = self::titleTopic($vars['page']['title'] ?? $title, basename($path));
            return self::fitTitle($topic . ' | Patient Guide');
        }
        if (str_starts_with($path, '/doctors/')) {
            return self::fitTitle(($vars['doctor']['name'] ?? 'Eye Doctor') . ' | Eye Specialist Delhi');
        }
        return self::fitTitle($title !== '' ? $title : 'Eye Care in Delhi | Jain Eye Hospital');
    }

    private static function titleTopic(string $title, string $fallback): string {
        $parts = preg_split('/\s*(?:—|–|:|\|)\s*/u', trim(strip_tags($title)), 2);
        $topic = trim((string)($parts[0] ?? ''));
        return $topic !== '' ? $topic : ucwords(str_replace('-', ' ', $fallback));
    }

    private static function fitTitle(string $title): string {
        $title = trim(preg_replace('/\s+/u', ' ', strip_tags($title)) ?? $title);
        if (mb_strlen($title) <= 60) return $title;

        $suffix = ' | Jain Eye Delhi';
        $head = mb_substr($title, 0, 60 - mb_strlen($suffix) - 1);
        $lastSpace = mb_strrpos($head, ' ');
        if ($lastSpace !== false) $head = mb_substr($head, 0, $lastSpace);
        return rtrim($head, ' —–:|') . '…' . $suffix;
    }

    private static function seoDescription(string $path, string $description, array $vars): string {
        $defaults = [
            '/why-choose-an-eye-specialist' => 'Learn why different eye concerns may need different sub-specialists and how to prepare for a careful eye examination in Delhi.',
            '/videos' => 'Explore an educational eye-care video from Jain Eye Hospital, Shalimar Bagh, Delhi. Learn basic concepts and prepare questions; videos do not diagnose or replace an examination.',
            '/privacy-policy' => 'Read what appointment and enquiry forms collect, how consented second-opinion reports are handled, and how to request access or deletion of your information.',
            '/terms' => 'Review the terms for using this eye-care education and specialist-discovery website, including appointment requests and the limits of online information.',
            '/medical-disclaimer' => 'Eye-care information on this website is educational and does not diagnose or replace an examination. Learn when urgent professional assessment may be needed.',
            '/accessibility' => 'Read about accessible navigation, forms, contrast and motion choices on the Jain Eye Hospital specialist-discovery website.',
            '/sitemap' => 'Browse eye-care guides, specialist information, patient resources, hospital details and policies on the Jain Eye Hospital Delhi website.',
        ];
        $description = trim(preg_replace('/\s+/u', ' ', strip_tags($description)) ?? $description);
        if ($description === '') $description = $defaults[$path] ?? 'Find practical eye-care guidance, patient resources and hospital information for Jain Eye Hospital, Shalimar Bagh, Delhi.';

        if (mb_strlen($description) < 112 && !isset($defaults[$path])) {
            $addition = ' Use it to prepare questions for an eye-care consultation in Shalimar Bagh, Delhi.';
            if (mb_strlen($description . $addition) <= 160) $description .= $addition;
        }
        if (mb_strlen($description) <= 160) return $description;

        $short = mb_substr($description, 0, 157);
        $lastSpace = mb_strrpos($short, ' ');
        if ($lastSpace !== false) $short = mb_substr($short, 0, $lastSpace);
        return rtrim($short, ' ,;:—–') . '…';
    }

    private static function seoKeywords(string $path, string $title, array $vars): string {
        $fixed = [
            '/' => ['eye specialist Delhi', 'eye doctor Delhi', 'eye hospital Shalimar Bagh', 'Jain Eye Hospital'],
            '/about' => ['Jain Eye Hospital Delhi', 'eye care guidance', 'ophthalmology Shalimar Bagh', 'patient-first eye care'],
            '/find-an-eye-doctor' => ['find an eye doctor Delhi', 'eye specialist finder', 'ophthalmologist Shalimar Bagh', 'eye symptoms guide'],
            '/doctors' => ['eye doctors Delhi', 'eye specialists Shalimar Bagh', 'ophthalmologist profiles', 'Jain Eye Hospital team'],
            '/why-choose-an-eye-specialist' => ['eye specialist Delhi', 'ophthalmology sub-specialities', 'choose an eye doctor', 'eye-care consultation'],
            '/eye-concerns' => ['eye symptoms and concerns', 'eye care guide Delhi', 'eye specialist finder', 'Jain Eye Hospital'],
            '/second-opinion' => ['eye treatment second opinion', 'eye reports review', 'eye specialist Delhi', 'private second opinion'],
            '/book-appointment' => ['book eye consultation Delhi', 'eye hospital appointment', 'Jain Eye Hospital booking', 'Shalimar Bagh eye care'],
            '/contact' => ['Jain Eye Hospital contact', 'eye hospital phone Delhi', 'Shalimar Bagh eye hospital', 'info@jaineye.com'],
            '/location/adarsh-nagar-delhi' => ['eye hospital Shalimar Bagh location', 'eye clinic directions Delhi', 'Jain Eye Hospital address', 'eye specialist near Adarsh Nagar'],
            '/faqs' => ['eye care FAQs', 'eye doctor questions Delhi', 'eye appointment information', 'Jain Eye Hospital'],
            '/articles' => ['eye care guides', 'patient eye health education', 'eye specialist Delhi', 'Jain Eye Hospital Knowledge Hub'],
            '/videos' => ['eye care video', 'eye anatomy education', 'patient eye health guide', 'Jain Eye Hospital Delhi'],
            '/gallery' => ['Jain Eye Hospital gallery', 'eye examination photos', 'ophthalmic care Delhi', 'hospital facilities Shalimar Bagh'],
            '/privacy-policy' => ['Jain Eye Hospital privacy policy', 'patient form privacy', 'second opinion report privacy', 'health data rights'],
            '/terms' => ['Jain Eye Hospital website terms', 'eye care information terms', 'appointment request terms', 'Delhi eye care'],
            '/medical-disclaimer' => ['eye care medical disclaimer', 'educational eye health information', 'eye examination advice', 'urgent eye symptoms'],
            '/accessibility' => ['accessible eye care website', 'website accessibility', 'Jain Eye Hospital Delhi'],
            '/sitemap' => ['Jain Eye Hospital sitemap', 'eye care pages Delhi', 'patient guides and eye specialists'],
        ];
        if (isset($fixed[$path])) return implode(', ', $fixed[$path]);

        if (str_starts_with($path, '/eye-concerns/')) {
            $topic = self::titleTopic($vars['page']['h1'] ?? $title, basename($path));
            return implode(', ', [$topic, $topic . ' symptoms', $topic . ' specialist Delhi', 'eye concern guide', 'eye care Shalimar Bagh']);
        }
        if (str_starts_with($path, '/eye-care/')) {
            $topic = self::titleTopic($vars['page']['title'] ?? $title, basename($path));
            return implode(', ', [$topic, $topic . ' Delhi', $topic . ' specialist', 'eye treatment options', 'Jain Eye Hospital']);
        }
        if (str_starts_with($path, '/patient-guide/')) {
            $topic = ucwords(str_replace('-', ' ', basename($path)));
            return implode(', ', [$topic, 'eye consultation guide', 'patient eye-care preparation', 'Jain Eye Hospital Delhi']);
        }
        if (str_starts_with($path, '/doctors/')) {
            $doctor = $vars['doctor']['name'] ?? 'eye doctor';
            return implode(', ', [$doctor, 'eye specialist Delhi', 'Jain Eye Hospital doctor profile', 'Shalimar Bagh ophthalmologist']);
        }

        return implode(', ', [self::titleTopic($title, basename($path)), 'eye care Delhi', 'Jain Eye Hospital Shalimar Bagh']);
    }

    private static function render(string $view, array $vars = [], string $metaTitle = '', string $metaDesc = ''): void {
        extract($vars, EXTR_SKIP);
        $bodyRoute = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $pageTitle = self::seoTitle($bodyRoute, $metaTitle, $vars);
        $metaDescription = self::seoDescription($bodyRoute, $metaDesc, $vars);
        $metaKeywords = self::seoKeywords($bodyRoute, $metaTitle, $vars);
        $metaImage = '/public/assets/images/clinical/neha-mohan-4.webp';
        $canonicalPath = rtrim($bodyRoute, '/') ?: '/';
        $canonical = APP_URL . $canonicalPath;
        $schemaNodes = [[
            '@type' => 'MedicalClinic',
            'name' => HOSPITAL_NAME,
            'url' => APP_URL,
            'telephone' => array_values(HOSPITAL_PHONES),
            'email' => HOSPITAL_EMAIL,
            'logo' => APP_URL . '/public/assets/images/jain-eye-hospital-logo.webp',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'AG 152, Shalimar Bagh',
                'addressLocality' => 'Delhi',
                'postalCode' => '110088',
                'addressCountry' => 'IN',
            ],
            'medicalSpecialty' => ['Ophthalmology'],
        ]];
        $faqEntries = $vars['faqs'] ?? ($vars['page']['faq'] ?? []);
        if ($faqEntries) {
            $schemaFaqs = [];
            foreach ($faqEntries as $faq) {
                if (empty($faq['question']) || empty($faq['answer'])) continue;
                $schemaFaqs[] = [
                    '@type' => 'Question',
                    'name' => (string)$faq['question'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => (string)$faq['answer']],
                ];
            }
            if ($schemaFaqs) $schemaNodes[] = ['@type' => 'FAQPage', 'mainEntity' => $schemaFaqs];
        }
        $schemaGraph = ['@context' => 'https://schema.org', '@graph' => $schemaNodes];
        require dirname(__DIR__, 2) . '/views/layouts/main.php';
    }

    // ---------------- HOME (exactly 12 sections, rendered in views/pages/home.php) ----------------
    private static function home(): void {
        $doctors = [];
        try {
            $doctors = Database::pdo()->query(
                "SELECT slug,name,designation,qualifications,focus_areas,photo_path FROM doctors
                 WHERE status='published' AND deleted_at IS NULL ORDER BY sort_order LIMIT 6")->fetchAll();
        } catch (Throwable $e) {}
        $articles = [];
        try {
            $articles = Database::pdo()->query(
                "SELECT slug,title,excerpt,reviewer_name,reviewed_at FROM articles
                 WHERE status='published' ORDER BY created_at DESC LIMIT 3")->fetchAll();
        } catch (Throwable $e) {}
        $testimonials = [];
        try {
            $testimonials = Database::pdo()->query(
                "SELECT patient_name,content,treatment_ref FROM testimonials
                 WHERE status='published' AND consent_given=1 ORDER BY created_at DESC LIMIT 4")->fetchAll();
        } catch (Throwable $e) {}
        self::render('home', ['doctors' => $doctors, 'articles' => $articles ?: self::editorialGuides(), 'testimonials' => $testimonials],
            'Eye Specialist in Delhi | Jain Eye Hospital',
            'Searching for the best eye doctor in Delhi? Learn how to choose the right sub-specialist and book coordinated care at Jain Eye Hospital, Shalimar Bagh.');
    }

    private static function about(): void {
        self::render('about', [], 'About Jain Eye Hospital & Eye Care Guidance',
            'Why this website exists, how we connect patients with verified eye specialists at Jain Eye Hospital & Laser Centre, Delhi, and the principles behind our content.');
    }

    private static function doctorsIndex(): void {
        $doctors = [];
        try {
            $doctors = Database::pdo()->query(
                "SELECT d.*, GROUP_CONCAT(s.name SEPARATOR ', ') AS specs
                 FROM doctors d LEFT JOIN doctor_specialities ds ON ds.doctor_id=d.id
                 LEFT JOIN specialities s ON s.id=ds.speciality_id
                 WHERE d.status='published' AND d.deleted_at IS NULL
                 GROUP BY d.id ORDER BY d.sort_order")->fetchAll();
        } catch (Throwable $e) {}
        self::render('doctors', ['doctors' => $doctors], 'Eye Specialists in Delhi | Jain Eye Hospital',
            'Meet the eye care team at Jain Eye Hospital & Laser Centre, Delhi. Verified qualifications, focus areas and direct booking.');
    }

    private static function doctorProfile(string $slug): void {
        $st = Database::pdo()->prepare(
            "SELECT d.*, GROUP_CONCAT(s.name SEPARATOR ', ') AS specs
             FROM doctors d LEFT JOIN doctor_specialities ds ON ds.doctor_id=d.id
             LEFT JOIN specialities s ON s.id=ds.speciality_id
             WHERE d.slug=? AND d.deleted_at IS NULL GROUP BY d.id");
        $st->execute([$slug]);
        $doctor = $st->fetch();
        if (!$doctor || $doctor['status'] !== 'published') { http_response_code(404); require dirname(__DIR__,2).'/views/errors/404.php'; return; }
        $creds = Database::pdo()->prepare("SELECT credential_type,title,issuer,year,verified FROM doctor_credentials WHERE doctor_id=? AND verified=1");
        $creds->execute([$doctor['id']]);
        self::render('doctor', ['doctor' => $doctor, 'credentials' => $creds->fetchAll()],
            $doctor['name'] . ' — ' . ($doctor['designation'] ?? 'Eye Specialist') . ' | Jain Eye Hospital Delhi',
            ($doctor['focus_areas'] ?? 'Eye care') . '. Verified profile and booking at Jain Eye Hospital & Laser Centre, Shalimar Bagh, Delhi.');
    }

    private static function concernsIndex(): void {
        self::render(
            'concerns',
            ['concerns' => self::data('concern')],
            'Eye Concerns & Symptoms Guide | Delhi',
            'Browse educational guides to common eye concerns, warning signs and questions to discuss with an eye-care professional in Delhi. These guides do not diagnose.'
        );
    }

    private static function longform(string $type, string $slug): void {
        $data = self::data($type);
        if (!isset($data[$slug])) { http_response_code(404); require dirname(__DIR__,2).'/views/errors/404.php'; return; }
        $page = $data[$slug];
        self::render($type, ['page' => $page, 'pageSlug' => $slug], $page['title'], substr(strip_tags($page['intro']), 0, 300));
    }

    private static function finder(): void { self::render('finder', [], 'Find an Eye Doctor in Delhi — 5-Step Specialist Guide', 'Answer 5 simple questions to find which eye specialist sub-speciality fits your concern. Guidance only — not a diagnosis.'); }
    private static function booking(): void {
        $doctors = [];
        try {
            $doctors = Database::pdo()->query("SELECT id,name FROM doctors WHERE status='published' AND deleted_at IS NULL ORDER BY sort_order")->fetchAll();
        } catch (Throwable $e) {
            // The form remains usable as "Help me choose" before cPanel DB setup.
        }
        self::render('booking', ['doctors' => $doctors], 'Book an Eye Consultation — Jain Eye Hospital, Shalimar Bagh Delhi', 'Request an appointment with the right eye specialist at Jain Eye Hospital & Laser Centre in Shalimar Bagh. Confirmed only after the hospital contacts you.');
    }
    private static function secondOpinion(): void { self::render('second-opinion', [], 'Second Opinion on Eye Treatment — Share Reports Privately', 'Upload your eye reports for a structured second opinion from the Jain Eye Hospital team. Private, consented, secure.'); }
    private static function contact(): void { self::render('contact', [], 'Contact — Jain Eye Hospital, Shalimar Bagh, Delhi', 'Address, phone numbers, email and enquiry form for Jain Eye Hospital & Laser Centre, Shalimar Bagh, Delhi.'); }
    private static function location(): void {
        $loc = [];
        try {
            $loc = Database::pdo()->query("SELECT * FROM locations WHERE status='published' LIMIT 1")->fetch() ?: [];
        } catch (Throwable $e) {}
        self::render('location', ['loc' => $loc], 'Location & Directions — Shalimar Bagh, Delhi | Jain Eye Hospital', 'Jain Eye Hospital & Laser Centre is at AG 152, Shalimar Bagh, Delhi 110088. Directions, timings and parking.');
    }
    private static function faqs(): void {
        $faqs = [];
        try {
            $faqs = Database::pdo()->query("SELECT question,answer FROM faqs WHERE status='published' ORDER BY sort_order")->fetchAll();
        } catch (Throwable $e) {}
        self::render('faqs', ['faqs' => $faqs ?: self::fallbackFaqs()], 'Eye Care FAQs | Jain Eye Hospital Delhi', 'Answers about choosing an eye specialist, preparing for an appointment, second opinions and when to seek urgent eye care in Delhi.');
    }
    private static function articles(): void {
        $rows = [];
        try {
            $rows = Database::pdo()->query("SELECT a.slug,a.title,a.excerpt,a.reviewer_name,a.reviewed_at,c.name AS cat
                FROM articles a LEFT JOIN article_categories c ON c.id=a.category_id
                WHERE a.status='published' ORDER BY a.created_at DESC")->fetchAll();
        } catch (Throwable $e) {}
        self::render('articles', ['articles' => $rows ?: self::editorialGuides()], 'Eye Care Knowledge Hub | Jain Eye Hospital', 'Plain-language eye-care guidance to help you prepare for an examination, understand common concerns and ask informed questions. Educational information is not a diagnosis.');
    }
    private static function article(string $slug): void {
        $a = false;
        try {
            $st = Database::pdo()->prepare("SELECT a.*,c.name AS cat FROM articles a LEFT JOIN article_categories c ON c.id=a.category_id WHERE a.slug=? AND a.status='published'");
            $st->execute([$slug]);
            $a = $st->fetch();
        } catch (Throwable $e) {}
        if (!$a) { http_response_code(404); require dirname(__DIR__,2).'/views/errors/404.php'; return; }
        self::render('article', ['a' => $a], $a['title'] . ' | Knowledge Hub', $a['excerpt'] ?? '');
    }
    private static function legal(string $which): void {
        self::render('legal', ['which' => $which], ucwords(str_replace('-', ' ', $which)) . ' | besteyedoctordelhi.com', '');
    }
    private static function staticPage(string $which): void {
        if ($which === 'gallery') {
            $items = require dirname(__DIR__) . '/data/gallery.php';
            self::render(
                'gallery',
                ['items' => $items],
                'Hospital Gallery | Jain Eye Hospital & Laser Centre',
                'Explore hospital spaces, eye examinations, clinical equipment and ophthalmic surgical care.'
            );
            return;
        }
        $title = $which === 'videos' ? 'Eye Care Videos | Jain Eye Hospital Delhi' : 'Why Choose an Eye Specialist? | Jain Eye';
        $description = $which === 'videos'
            ? 'Explore an educational eye-care video from Jain Eye Hospital, Shalimar Bagh, Delhi. Learn basic concepts and prepare questions; videos do not diagnose or replace an examination.'
            : 'Learn why different eye concerns may need different sub-specialists and how to prepare for a careful eye examination in Delhi.';
        self::render('static', ['which' => $which], $title, $description);
    }
}
