
<section class="page-hero"><div class="wrap">
  <p class="eyebrow">Knowledge hub</p>
  <h1>Knowledge Hub</h1>
  <p class="lead">Clear, practical eye-care information to help you prepare for a visit and ask better questions. These guides are educational, not a diagnosis.</p>
</div></section>
<section class="section"><div class="wrap knowledge-card-grid">
  <?php $loopIndex = 0; foreach ($articles as $a): ?>
  <?php
    $articleHref = $a['link'] ?? ('/articles/' . rawurlencode($a['slug']));
    $articleImage = $a['image'] ?? '/public/assets/images/clinical/hospital-pic-9.webp';
    $articleAlt = $a['image_alt'] ?? 'A welcoming eye-care clinic environment';
    $isReviewed = !empty($a['reviewer_name']) && !empty($a['reviewed_at']);
  ?>
  <a class="knowledge-card" href="<?= e($articleHref) ?>">
    <div class="knowledge-card-image"><img src="<?= e($articleImage) ?>" alt="<?= e($articleAlt) ?>" loading="<?= $loopIndex < 3 ? 'eager' : 'lazy' ?>" width="640" height="360"></div>
    <div class="knowledge-card-copy">
      <p class="eyebrow"><?= e($a['cat'] ?? 'Patient guide') ?></p>
      <h2><?= e($a['title']) ?></h2>
      <p><?= e($a['excerpt'] ?? 'Explore this eye-care guide and prepare questions for your next visit.') ?></p>
      <p class="knowledge-review-status"><?= $isReviewed ? 'Reviewed by ' . e($a['reviewer_name']) . ' · ' . e($a['reviewed_at']) : 'Patient education · Not a diagnosis' ?></p>
      <span class="knowledge-card-link">Read guide <b aria-hidden="true">→</b></span>
    </div>
  </a>
  <?php $loopIndex = ($loopIndex ?? 0) + 1; ?>
  <?php endforeach; ?>
  <?php if (!$articles): ?><p class="muted">There are no guides to show right now. Use the specialist finder or contact the hospital for help choosing a next step.</p><?php endif; ?>
</div></section>
