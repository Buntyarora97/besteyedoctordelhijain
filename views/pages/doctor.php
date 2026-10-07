
<section class="page-hero"><div class="wrap">
  <nav class="breadcrumbs" aria-label="Breadcrumb"><a href="/">Home</a> / <a href="/doctors">Doctors</a> / <span><?= e($doctor['name']) ?></span></nav>
  <h1><?= e($doctor['name']) ?></h1>
  <p class="lead"><?= e($doctor['designation']) ?> — <?= e($doctor['specs']) ?></p>
</div></section>
<section class="section"><div class="wrap prose">
  <?php if (!empty($doctor['qualifications_verified'])): ?>
    <h2>Qualifications</h2><p><?= e($doctor['qualifications']) ?></p>
  <?php else: ?>
    <p class="disclaimer">Qualifications are pending hospital verification and are shown only after approval.</p>
  <?php endif; ?>
  <?php if ($credentials): ?>
    <h2>Verified credentials</h2>
    <ul><?php foreach ($credentials as $c): ?>
      <li><?= e($c['credential_type']) ?>: <?= e($c['title']) ?><?= $c['issuer'] ? ' — ' . e($c['issuer']) : '' ?><?= $c['year'] ? ' (' . (int)$c['year'] . ')' : '' ?></li>
    <?php endforeach; ?></ul>
  <?php endif; ?>
  <h2>Focus areas</h2><p><?= e($doctor['focus_areas']) ?></p>
  <h2>Profile</h2><p><?= e($doctor['bio']) ?></p>
  <div class="cta-panel">
    <p>Consultations are confirmed only after the hospital contacts you.</p>
    <a class="btn btn-primary" href="/book-appointment?doctor=<?= (int)$doctor['id'] ?>">Book With This Doctor</a>
    <a class="btn btn-outline" href="/second-opinion">Get a Second Opinion</a>
  </div>
</div></section>
