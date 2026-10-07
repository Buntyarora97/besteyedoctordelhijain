
<section class="page-hero"><div class="wrap">
  <h1>Frequently Asked Questions</h1>
  <p class="lead">Honest answers about choosing specialists, booking and what to expect.</p>
</div></section>
<section class="section"><div class="wrap">
  <?php foreach ($faqs as $f): ?>
  <details class="faq-item"><summary><?= e($f['question']) ?></summary><p><?= e($f['answer']) ?></p></details>
  <?php endforeach; ?>
  <?php if (!$faqs): ?><p class="muted">FAQs are being reviewed and will appear here shortly.</p><?php endif; ?>
  <div class="cta-panel" style="margin-top:32px">
    <p>Still unsure? Tell us your concern and our team will guide your booking.</p>
    <a class="btn btn-primary" href="/contact">Ask Us</a>
  </div>
</div></section>
