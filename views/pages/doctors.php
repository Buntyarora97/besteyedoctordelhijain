
<section class="page-hero"><div class="wrap">
  <nav class="breadcrumbs" aria-label="Breadcrumb"><a href="/">Home</a> / <span>Doctors</span></nav>
  <h1>Eye Specialists at Jain Eye Hospital, Delhi</h1>
  <p class="lead">Only hospital-verified profiles are published here. No unverified experience years or surgery counts are ever shown.</p>
</div></section>
<section class="section"><div class="wrap">
  <?php if ($doctors): ?>
  <div class="card-grid">
  <?php foreach ($doctors as $d): ?>
  <article class="card doctor-card">
    <h2><?= e($d['name']) ?></h2>
    <p class="muted"><?= e($d['designation']) ?></p>
    <?php if (!empty($d['qualifications_verified'])): ?><p><?= e($d['qualifications']) ?></p><?php endif; ?>
    <p><?= e($d['specs']) ?></p>
    <div class="card-actions">
      <a class="btn btn-outline" href="/doctors/<?= e($d['slug']) ?>">View Profile</a>
      <a class="btn btn-primary" href="/book-appointment?doctor=<?= (int)$d['id'] ?>">Book</a>
    </div>
  </article>
  <?php endforeach; ?>
  </div>
  <?php else: ?>
  <div class="doctor-verification-panel">
    <figure class="doctor-verification-image">
      <img src="/public/assets/images/clinical/neha-mohan-4.webp" alt="An eye examination using a slit-lamp instrument" width="840" height="600">
      <figcaption>Eye examination · illustrative clinical photo</figcaption>
    </figure>
    <div class="doctor-verification-copy">
      <p class="eyebrow">Profile review in progress</p>
      <h2>Specialist details should be clear and verifiable.</h2>
      <p>Doctor names, qualifications and practice areas will be shown here only after the hospital confirms them. We will not fill this page with guessed biographies or unverified claims.</p>
      <ul>
        <li>Qualifications checked before publication</li>
        <li>Practice areas matched to the published profile</li>
        <li>Appointment requests confirmed by the hospital</li>
      </ul>
      <div class="doctor-verification-actions">
        <a class="btn btn-primary" href="/find-an-eye-doctor">Explore care pathways</a>
        <a class="text-link" href="/contact">Ask the hospital a question <b aria-hidden="true">→</b></a>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div></section>
