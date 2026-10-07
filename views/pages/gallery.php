<?php
$galleryLabels = [
    'facility' => 'Hospital spaces',
    'access' => 'Area & access',
    'consultation' => 'Eye examinations',
    'diagnostics' => 'Clinical equipment',
    'surgery' => 'Surgical care',
    'team' => 'Clinical team',
    'patient-care' => 'Patient care',
];
$groups = array_values(array_unique(array_column($items, 'category')));
$galleryImageRoot = '/public/assets/images/clinical/';
$galleryPhoneHref = preg_replace('/[^0-9+]/', '', HOSPITAL_PHONE);
?>
<section class="gallery-hero">
  <div class="wrap">
    <nav class="breadcrumbs" aria-label="Breadcrumb"><a href="/">Home</a><span aria-hidden="true">/</span><span aria-current="page">Hospital gallery</span></nav>
    <div class="gallery-hero-grid">
      <div class="gallery-hero-copy">
        <p class="eyebrow">Jain Eye Hospital &amp; Laser Centre</p>
        <h1>Care, spaces<br><em>and people.</em></h1>
        <p class="lead">A photo tour of the hospital, eye examinations, clinical equipment and ophthalmic care.</p>
        <a class="btn btn-primary" href="/book-appointment">Plan a visit <span aria-hidden="true">→</span></a>
      </div>
      <figure class="gallery-hero-image">
        <img src="<?= e($galleryImageRoot . 'neha-mohan-4.webp') ?>" alt="An ophthalmologist examining a patient with a slit lamp" width="900" height="620">
        <figcaption>Eye care, explained with context</figcaption>
      </figure>
    </div>
  </div>
</section>

<section class="section gallery-section" aria-labelledby="gallery-heading">
  <div class="wrap">
    <div class="gallery-heading">
      <div><p class="eyebrow">Photo gallery</p><h2 id="gallery-heading">A closer look at care.</h2></div>
      <p>Choose a category or open a photo for a larger view. Images are illustrative views of hospital spaces and eye-care work.</p>
    </div>
    <div class="gallery-filters" role="group" aria-label="Filter gallery photos">
      <button type="button" data-gallery-filter="all" aria-pressed="true">All photos</button>
      <?php foreach ($groups as $group): ?>
        <button type="button" data-gallery-filter="<?= e($group) ?>" aria-pressed="false"><?= e($galleryLabels[$group] ?? ucfirst($group)) ?></button>
      <?php endforeach; ?>
    </div>
    <p class="sr-only" id="galleryStatus" role="status" aria-live="polite"></p>
    <div class="gallery-grid" data-gallery-grid>
      <?php foreach ($items as $index => $item): ?>
        <a class="gallery-card" href="<?= e($galleryImageRoot . $item['src']) ?>" data-gallery-open data-gallery-category="<?= e($item['category']) ?>" data-gallery-title="<?= e($item['title']) ?>">
          <figure>
            <img src="<?= e($galleryImageRoot . $item['src']) ?>" alt="<?= e($item['alt']) ?>" loading="<?= $index < 6 ? 'eager' : 'lazy' ?>" decoding="async" fetchpriority="<?= $index === 0 ? 'high' : 'auto' ?>" width="800" height="600">
            <span class="gallery-card-index"><?= sprintf('%02d', $index + 1) ?></span>
            <figcaption><span class="gallery-card-category"><?= e($galleryLabels[$item['category']] ?? ucfirst($item['category'])) ?></span><strong><?= e($item['title']) ?></strong><span class="gallery-open-mark" aria-hidden="true">↗</span></figcaption>
          </figure>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<dialog class="gallery-lightbox" id="galleryLightbox" aria-label="Gallery photo viewer">
  <div class="gallery-lightbox-toolbar">
    <p id="galleryLightboxCaption"></p>
    <button type="button" data-gallery-close aria-label="Close photo viewer">×</button>
  </div>
  <div class="gallery-lightbox-stage">
    <button type="button" data-gallery-previous aria-label="Previous photo">‹</button>
    <img id="galleryLightboxImage" src="" alt="">
    <button type="button" data-gallery-next aria-label="Next photo">›</button>
  </div>
</dialog>

<section class="gallery-visit">
  <div class="wrap gallery-visit-inner">
    <div><p class="eyebrow">Planning your visit</p><h2>Need help choosing where to start?</h2><p>Tell us what you need and the hospital team can guide you to the next step.</p></div>
    <div><a class="btn btn-primary" href="/contact">Contact the hospital <span aria-hidden="true">→</span></a><a class="gallery-phone" href="tel:<?= e($galleryPhoneHref) ?>">Call <?= e(HOSPITAL_PHONE) ?></a></div>
  </div>
</section>
