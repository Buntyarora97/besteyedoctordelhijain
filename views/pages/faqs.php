
<section class="page-hero"><div class="wrap">
  <p class="eyebrow">Plan your visit</p>
  <h1>Frequently Asked Questions</h1>
  <p class="lead">Straightforward information about eye-care guides, appointment requests, records and urgent symptoms. Online information does not replace an eye examination.</p>
</div></section>
<section class="section"><div class="wrap faq-layout">
  <div class="faq-list">
  <?php foreach ($faqs as $f): ?>
  <details class="faq-item"><summary><?= e($f['question']) ?></summary><p><?= e($f['answer']) ?></p></details>
  <?php endforeach; ?>
  <?php if (!$faqs): ?><p class="muted">There are no answers to display right now. Contact the hospital for help with a specific visit question.</p><?php endif; ?>
  </div>
  <div class="cta-panel" style="margin-top:32px">
    <p class="eyebrow">Need a next step?</p>
    <h2>Start with your concern.</h2>
    <p>Use the specialist finder for educational guidance, or contact the hospital with an appointment question.</p>
    <a class="btn btn-outline" href="/find-an-eye-doctor">Find a specialist</a>
    <a class="text-link" href="/contact">Contact the hospital <b aria-hidden="true">→</b></a>
  </div>
</div></section>
