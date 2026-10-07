<?php
$concernVisuals = [
    'blurry-vision' => ['/public/assets/images/clinical/neha-mohan-4.webp', 'Slit-lamp eye examination'],
    'sudden-vision-changes' => ['/public/assets/images/clinical/hospital-pic-17.webp', 'Ophthalmic diagnostic equipment'],
    'flashes-and-floaters' => ['/public/assets/images/clinical/rajat-jain-4.webp', 'An eye-care clinician examining a patient'],
    'red-or-painful-eye' => ['/public/assets/images/clinical/neha-mohan-2.webp', 'An ophthalmologist examining a patient'],
    'watery-or-dry-eyes' => ['/public/assets/images/clinical/rajat-jain-5.webp', 'Slit-lamp eye examination'],
    'poor-night-vision' => ['/public/assets/images/clinical/hospital-pic-16.webp', 'Equipment used during an eye examination'],
    'diabetes-and-eye-health' => ['/public/assets/images/clinical/hospital-pic-11.webp', 'Ophthalmic equipment in a clinical room'],
    'child-eye-problems' => ['/public/assets/images/clinical/hospital-pic-14.webp', 'Eye examination room'],
    'premature-baby-eye-screening' => ['/public/assets/images/clinical/hospital-pic-12.webp', 'Clinical procedure room'],
    'squint' => ['/public/assets/images/clinical/neha-mohan-3.webp', 'Ophthalmologist in a clinical setting'],
];
?>
<section class="page-hero concerns-hero">
  <div class="wrap">
    <nav class="breadcrumbs" aria-label="Breadcrumb"><a href="/">Home</a><span aria-hidden="true">/</span><span aria-current="page">Eye concerns</span></nav>
    <p class="eyebrow">Understand your concern</p>
    <h1>Eye concerns, explained clearly.</h1>
    <p class="lead">Browse common symptoms and questions to help prepare for a clinical conversation. These guides offer general education, not a diagnosis.</p>
    <a class="btn btn-primary" href="/find-an-eye-doctor">Try the specialist finder <span aria-hidden="true">→</span></a>
  </div>
</section>

<section class="section concerns-section">
  <div class="wrap">
    <div class="concerns-heading">
      <div><p class="eyebrow">Patient education</p><h2>Start with what you have noticed.</h2></div>
      <p>Choose the closest topic. A clinician can assess your symptoms and advise what to do next.</p>
    </div>
    <div class="concerns-grid">
      <?php foreach ($concerns as $slug => $topic):
        $speciality = $topic['speciality'] ?? '';
        $visual = $concernVisuals[$slug] ?? ['/public/assets/images/clinical/neha-mohan-4.webp', 'Eye examination using a slit-lamp instrument'];
        $excerpt = trim(preg_replace('/\s+/u', ' ', strip_tags($topic['intro'] ?? 'Read this eye-care guide and prepare questions for your visit.')) ?? '');
        if (mb_strlen($excerpt) > 190) {
          $excerpt = mb_substr($excerpt, 0, 187);
          $lastSpace = mb_strrpos($excerpt, ' ');
          if ($lastSpace !== false) $excerpt = mb_substr($excerpt, 0, $lastSpace);
          $excerpt = rtrim($excerpt, ' ,;:—–') . '…';
        }
      ?>
      <a class="concern-guide-card" href="/eye-concerns/<?= e($slug) ?>">
        <div class="concern-guide-image"><img src="<?= e($visual[0]) ?>" alt="<?= e($visual[1]) ?>" loading="lazy" width="640" height="420"><span><?= e(ucwords(str_replace('-', ' ', $speciality ?: 'eye care'))) ?></span></div>
        <div class="concern-guide-copy"><h3><?= e($topic['h1'] ?? $topic['title'] ?? ucwords(str_replace('-', ' ', $slug))) ?></h3><p><?= e($excerpt) ?></p><span class="concern-guide-link">Read the guide <b aria-hidden="true">→</b></span></div>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="concerns-urgent-note">
      <span aria-hidden="true">!</span>
      <div><strong>Sudden vision loss, severe eye pain, a curtain-like shadow, eye injury or chemical exposure may need urgent assessment.</strong><p>Do not wait for an online reply. Contact the hospital or go to the nearest emergency service.</p></div>
      <a href="/patient-guide/emergency-eye-symptoms">Urgent eye symptoms <b aria-hidden="true">→</b></a>
    </div>
  </div>
</section>
