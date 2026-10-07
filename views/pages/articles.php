
<section class="page-hero"><div class="wrap">
  <h1>Knowledge Hub</h1>
  <p class="lead">Plain-language, medically reviewed eye care articles.</p>
</div></section>
<section class="section"><div class="wrap card-grid">
  <?php foreach ($articles as $a): ?>
  <a class="card" href="/articles/<?= e($a['slug']) ?>">
    <p class="eyebrow"><?= e($a['cat'] ?? 'Eye Care') ?></p>
    <h2><?= e($a['title']) ?></h2>
    <p><?= e($a['excerpt']) ?></p>
    <p class="muted">Reviewed by <?= e($a['reviewer_name'] ?: 'our clinical team') ?><?= $a['reviewed_at'] ? ' · ' . e($a['reviewed_at']) : '' ?></p>
  </a>
  <?php endforeach; ?>
  <?php if (!$articles): ?><p class="muted">Articles are being reviewed and will appear here shortly.</p><?php endif; ?>
</div></section>
