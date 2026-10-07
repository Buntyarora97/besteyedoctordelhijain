
<article class="section"><div class="wrap prose">
  <nav class="breadcrumbs" aria-label="Breadcrumb"><a href="/">Home</a> / <a href="/articles">Knowledge Hub</a> / <span><?= e($a['title']) ?></span></nav>
  <h1><?= e($a['title']) ?></h1>
  <p class="muted">Reviewed by <?= e($a['reviewer_name'] ?: 'our clinical team') ?>
    <?= $a['reviewed_at'] ? ' · Reviewed: ' . e($a['reviewed_at']) : '' ?>
    <?= $a['next_review_at'] ? ' · Next review: ' . e($a['next_review_at']) : '' ?></p>
  <?= $a['content'] /* stored HTML from trusted admin only */ ?>
  <?php if ($a['sources']): ?><h2>Sources</h2><p class="muted"><?= e($a['sources']) ?></p><?php endif; ?>
  <div class="cta-panel" style="margin-top:32px">
    <p>This article is educational and does not replace an eye examination.</p>
    <a class="btn btn-primary" href="/book-appointment">Book a Consultation</a>
  </div>
</div></article>
