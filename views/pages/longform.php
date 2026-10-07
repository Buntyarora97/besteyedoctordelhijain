<?php
$path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
$isConcernPage = str_starts_with($path, '/eye-concerns/');
$pageLabel = $isConcernPage ? 'Eye concern guide' : 'Specialist care';
$speciality = trim((string)($page['speciality'] ?? 'Eye care'));
$imageDirectory = '/public/assets/images/clinical/';
$pageImages = [
    'blurry-vision' => ['neha-mohan-4.webp', 'An ophthalmologist examining a patient with a slit lamp.'],
    'sudden-vision-changes' => ['hospital-pic-10.webp', 'Ophthalmic examination equipment in a clinical room.'],
    'flashes-and-floaters' => ['hospital-pic-17.webp', 'Ophthalmic diagnostic equipment in a clinical setting.'],
    'red-or-painful-eye' => ['hospital-pic-6.webp', 'An eye-care clinician speaking with a patient.'],
    'watery-or-dry-eyes' => ['neha-mohan-4.webp', 'An eye examination using clinical equipment.'],
    'poor-night-vision' => ['hospital-pic-11.webp', 'Eye examination equipment in a clinic room.'],
    'diabetes-and-eye-health' => ['hospital-pic-17.webp', 'Ophthalmic diagnostic equipment in a clinical setting.'],
    'child-eye-problems' => ['hospital-pic-14.webp', 'An ophthalmic examination room.'],
    'squint' => ['neha-mohan-4.webp', 'An ophthalmologist examining a patient with a slit lamp.'],
    'premature-baby-eye-screening' => ['hospital-pic-16.webp', 'Clinical equipment used in ophthalmic examinations.'],
    'cataract' => ['precision-ophthalmic-surgery-in-theatre.webp', 'Ophthalmic surgery performed under an operating microscope.'],
    'cornea-and-anterior-segment' => ['neha-mohan-4.webp', 'An eye examination using clinical equipment.'],
    'lasik-and-refractive-surgery' => ['hospital-pic-10.webp', 'Ophthalmic examination equipment in a clinical room.'],
    'retina-and-vitreous' => ['microsurgery-under-the-surgical-microscope.webp', 'Ophthalmic microsurgery under an operating microscope.'],
    'diabetic-retinopathy' => ['hospital-pic-17.webp', 'Ophthalmic diagnostic equipment in a clinical setting.'],
    'uveitis' => ['neha-mohan-4.webp', 'An ophthalmologist examining a patient with a slit lamp.'],
    'rop-screening' => ['hospital-pic-16.webp', 'Clinical equipment used in ophthalmic examinations.'],
    'glaucoma' => ['hospital-pic-11.webp', 'Eye examination equipment in a clinic room.'],
    'paediatric-ophthalmology' => ['hospital-pic-14.webp', 'An ophthalmic examination room.'],
    'squint-care' => ['neha-mohan-4.webp', 'An ophthalmologist examining a patient with a slit lamp.'],
    'dry-eye' => ['neha-mohan-4.webp', 'An eye examination using clinical equipment.'],
    'comprehensive-eye-check-up' => ['hospital-pic-16.webp', 'Clinical equipment used in ophthalmic examinations.'],
];
$image = $pageImages[$pageSlug] ?? ['neha-mohan-4.webp', 'An ophthalmologist examining a patient with a slit lamp.'];
$sectionIds = [];
foreach ($page['sections'] as $index => $section) {
    $sectionIds[] = 'guide-section-' . ($index + 1);
}
$phoneHref = preg_replace('/[^0-9+]/', '', HOSPITAL_PHONE);
?>

<section class="clinical-hero">
  <div class="wrap">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
      <a href="/">Home</a><span aria-hidden="true">/</span>
      <span><?= e($pageLabel) ?></span>
      <span aria-hidden="true">/</span><span aria-current="page"><?= e($page['h1']) ?></span>
    </nav>
    <div class="clinical-hero-grid">
      <div class="clinical-hero-copy">
        <p class="eyebrow clinical-eyebrow"><?= e($pageLabel) ?> <span aria-hidden="true">·</span> <?= e($speciality) ?></p>
        <h1><?= e($page['h1']) ?></h1>
        <p class="clinical-intro"><?= e($page['intro']) ?></p>
        <div class="clinical-actions">
          <a class="btn btn-primary" href="/book-appointment">Book a consultation <span aria-hidden="true">→</span></a>
          <a class="btn btn-outline" href="/contact">Contact the hospital</a>
        </div>
        <p class="clinical-reassurance">Clear information to help you prepare for a conversation with an eye-care professional.</p>
      </div>
      <figure class="clinical-hero-visual">
        <img src="<?= e($imageDirectory . $image[0]) ?>" alt="<?= e($image[1]) ?>" width="900" height="650">
        <figcaption><span aria-hidden="true">✳</span> Care explained with context</figcaption>
      </figure>
    </div>
  </div>
</section>

<section class="clinical-overview" aria-label="On this page">
  <div class="wrap clinical-overview-grid">
    <div class="clinical-overview-copy">
      <p class="eyebrow">A clearer place to start</p>
      <h2>Understand the concern.<br><em>Choose your next step.</em></h2>
      <p>Use this guide to learn what may be assessed and what questions to raise. It is educational information, not a diagnosis.</p>
    </div>
    <nav class="clinical-toc" aria-label="Sections in this guide">
      <?php foreach ($page['sections'] as $index => [$heading, $paragraph]): ?>
        <a href="#<?= e($sectionIds[$index]) ?>"><span><?= sprintf('%02d', $index + 1) ?></span><?= e($heading) ?><b aria-hidden="true">↗</b></a>
      <?php endforeach; ?>
      <?php if (!empty($page['redflags'])): ?><a class="clinical-toc-urgent" href="#urgent-assessment"><span>!</span>When to seek urgent care<b aria-hidden="true">↗</b></a><?php endif; ?>
      <?php if (!empty($page['faq'])): ?><a href="#common-questions"><span>?</span>Common questions<b aria-hidden="true">↗</b></a><?php endif; ?>
    </nav>
  </div>
</section>

<section class="section clinical-content">
  <div class="wrap clinical-content-grid">
    <article class="clinical-article">
      <div class="clinical-article-heading">
        <p class="eyebrow">The guide</p>
        <h2><?= e($page['title'] ?? $page['h1']) ?></h2>
      </div>
      <?php foreach ($page['sections'] as $index => [$heading, $paragraph]): ?>
        <section class="clinical-topic" id="<?= e($sectionIds[$index]) ?>">
          <span class="clinical-topic-number"><?= sprintf('%02d', $index + 1) ?></span>
          <div><h3><?= e($heading) ?></h3><p><?= e($paragraph) ?></p></div>
        </section>
      <?php endforeach; ?>

      <?php if (!empty($page['redflags'])): ?>
        <section class="clinical-urgent" id="urgent-assessment" aria-labelledby="urgent-heading">
          <div class="clinical-urgent-mark" aria-hidden="true">!</div>
          <div>
            <p class="eyebrow">Do not wait</p>
            <h2 id="urgent-heading">Please seek urgent assessment if you have</h2>
            <ul><?php foreach ($page['redflags'] as $flag): ?><li><?= e($flag) ?></li><?php endforeach; ?></ul>
            <a href="tel:<?= e($phoneHref) ?>">Call <?= e(HOSPITAL_PHONE) ?></a>
          </div>
        </section>
      <?php endif; ?>
    </article>

    <aside class="clinical-aside">
      <div class="clinical-aside-card">
        <p class="eyebrow">Your next step</p>
        <h2>Bring your questions to a consultation.</h2>
        <p>A clinician can assess your eyes, discuss what the findings mean and explain appropriate options.</p>
        <a class="btn btn-primary" href="/book-appointment">Book a visit <span aria-hidden="true">→</span></a>
        <a class="clinical-aside-call" href="tel:<?= e($phoneHref) ?>">Call <?= e(HOSPITAL_PHONE) ?></a>
      </div>
      <div class="clinical-aside-note">
        <span aria-hidden="true">✳</span>
        <p>This guide is for education and does not replace an eye examination or personalised medical advice.</p>
      </div>
    </aside>
  </div>
</section>

<?php if (!empty($page['faq'])): ?>
<section class="section clinical-faq" id="common-questions">
  <div class="wrap clinical-faq-layout">
    <div class="clinical-faq-heading">
      <p class="eyebrow">Questions, answered</p>
      <h2>What people often ask.</h2>
      <p>These answers are a starting point. Your clinician can advise based on an examination.</p>
    </div>
    <div class="clinical-faq-list">
      <?php foreach ($page['faq'] as [$question, $answer]): ?>
        <details class="clinical-faq-item"><summary><?= e($question) ?><span aria-hidden="true">+</span></summary><p><?= e($answer) ?></p></details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="clinical-end">
  <div class="wrap clinical-end-panel">
    <div><p class="eyebrow">Jain Eye Hospital &amp; Laser Centre</p><h2>A clear next step starts with a conversation.</h2><p>Book an appointment or contact the hospital if you need help planning your visit.</p></div>
    <div class="clinical-end-actions"><a class="btn btn-primary" href="/book-appointment">Book a consultation <span aria-hidden="true">→</span></a><a class="btn btn-outline light" href="/second-opinion">Request a second opinion</a></div>
  </div>
  <p class="clinical-disclaimer">Information on this page is educational and does not replace an examination, diagnosis or personalised medical advice.</p>
</section>
