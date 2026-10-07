
<section class="page-hero"><div class="wrap">
  <nav class="breadcrumbs" aria-label="Breadcrumb"><a href="/">Home</a> / <span>Doctors</span></nav>
  <h1>Eye Specialists at Jain Eye Hospital, Delhi</h1>
  <p class="lead">Only hospital-verified profiles are published here. No unverified experience years or surgery counts are ever shown.</p>
</div></section>
<section class="section"><div class="wrap card-grid">
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
  <?php if (!$doctors): ?><p class="muted">Doctor profiles are currently being verified by the hospital and will appear here once approved.</p><?php endif; ?>
</div></section>
