
<section class="page-hero"><div class="wrap">
  <h1>Location &amp; Directions</h1>
  <p class="lead"><?= e(HOSPITAL_ADDRESS) ?></p>
</div></section>
<section class="section"><div class="wrap split">
  <div class="prose">
    <h2>Getting here</h2>
    <p>Use this address when planning your visit: <?= e(HOSPITAL_ADDRESS) ?>.</p>
    <h2>Timings</h2>
    <p><?= e($loc['timings'] ?? setting('timings', 'Verification pending — please call to confirm.')) ?></p>
    <?php if (setting('holiday_note')): ?><p class="muted">Holidays: <?= e(setting('holiday_note')) ?></p><?php endif; ?>
    <p class="microcopy">Exact map pin and parking details are published after verification.</p>
    <a class="btn btn-primary" href="/book-appointment">Book a Consultation</a>
  </div>
  <div>
    <?php if (!empty($loc['map_embed'])): ?>
      <div class="map-embed"><iframe title="Map showing Jain Eye Hospital, Shalimar Bagh, Delhi" loading="lazy" src="https://www.google.com/maps?q=<?= e(rawurlencode(HOSPITAL_ADDRESS)) ?>&amp;output=embed"></iframe></div>
    <?php else: ?>
      <div class="map-embed"><iframe title="Map showing Jain Eye Hospital, Shalimar Bagh, Delhi" loading="lazy" src="https://www.google.com/maps?q=<?= e(rawurlencode(HOSPITAL_ADDRESS)) ?>&amp;output=embed"></iframe></div>
    <?php endif; ?>
  </div>
</div></section>
