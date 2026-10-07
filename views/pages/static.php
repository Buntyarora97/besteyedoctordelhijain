
<section class="page-hero"><div class="wrap"><h1><?= e(ucwords(str_replace('-', ' ', $which))) ?></h1></div></section>
<section class="section"><div class="wrap prose">
<?php if ($which === 'why-choose-an-eye-specialist'): ?>
  <p class="eyebrow">Choosing care</p>
  <h2>Start with an examination, not a ranking.</h2>
  <p>Eye concerns can involve different structures and may need different expertise. A comprehensive eye-care professional can assess your symptoms, explain what they find and refer you to another specialist when that is appropriate.</p>
  <h2>How a specialist can help</h2>
  <p>Ophthalmology includes care for the cornea and lens, retina and vitreous, optic nerve, children's vision and other areas. The right route depends on your history and examination—not a website ranking or a single symptom alone.</p>
  <p>Our five-step specialist finder is an educational starting point. It does not diagnose, determine urgency or replace advice from a clinician.</p>
  <div class="static-page-actions"><a class="btn btn-primary" href="/find-an-eye-doctor">Use the specialist finder</a><a class="text-link" href="/eye-concerns">Browse eye concerns <b aria-hidden="true">→</b></a></div>
<?php elseif ($which === 'videos'): ?>
  <p class="eyebrow">Patient education</p>
  <h2>A visual introduction to the eye</h2>
  <p>This short animation introduces basic eye structures and is intended to help you prepare questions. It does not explain an individual diagnosis or treatment plan.</p>
  <div class="video-guide-layout">
    <div class="video-guide-player">
      <video controls playsinline preload="metadata" poster="/public/assets/images/clinical/eye-care-journey-poster.webp" aria-label="Educational animation introducing eye structures">
        <source src="/public/assets/videos/eye-care-journey.mp4" type="video/mp4">
        Your browser does not support this video. Visit the eye-concern guides for written information.
      </video>
    </div>
    <aside class="video-guide-note"><span class="eyebrow">Keep in mind</span><h3>One symptom can have more than one cause.</h3><p>Use this animation to learn general terms, then discuss personal symptoms with an eye-care professional.</p><a class="text-link" href="/find-an-eye-doctor">Explore care pathways <b aria-hidden="true">→</b></a></aside>
  </div>
  <div class="video-related-links">
    <a href="/eye-concerns/blurry-vision"><span>01</span><strong>Understand blurry vision</strong><b aria-hidden="true">→</b></a>
    <a href="/patient-guide/first-visit"><span>02</span><strong>Prepare for a first visit</strong><b aria-hidden="true">→</b></a>
    <a href="/faqs"><span>03</span><strong>Read eye-care FAQs</strong><b aria-hidden="true">→</b></a>
  </div>
<?php else: ?>
  <p>Explore the existing eye-care information and contact pages for practical next steps.</p>
  <div class="static-page-actions"><a class="btn btn-primary" href="/find-an-eye-doctor">Find a specialist</a><a class="text-link" href="/contact">Contact the hospital <b aria-hidden="true">→</b></a></div>
<?php endif; ?>
</div></section>
