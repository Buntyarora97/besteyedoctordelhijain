<?php
/* The homepage follows the 12-section content map from the supplied brief. */
$homeImages = [
  'hero' => '/public/assets/images/clinical/hospital-pic-13.webp',
  'team' => '/public/assets/images/clinical/rajat-jain-2.webp',
  'care' => '/public/assets/images/clinical/hospital-pic-4.webp',
  'clinic' => '/public/assets/images/clinical/hospital-pic-8.webp',
  'consultation' => '/public/assets/images/clinical/neha-mohan-4.webp',
  'waiting' => '/public/assets/images/clinical/hospital-pic-9.webp',
  'diagnostics' => '/public/assets/images/clinical/hospital-pic-16.webp',
];
?>

<!-- 1. Premium bilingual hero -->
<section class="hero hero-home hero-refresh">
  <div class="hero-refresh-glow" aria-hidden="true"></div>
  <div class="wrap hero-refresh-grid">
    <div class="hero-copy">
      <p class="eyebrow">Eye specialist guidance in Delhi</p>
      <h1>Clear vision begins with the right <em>care.</em></h1>
      <p class="hero-hindi" lang="hi">आपकी आँखों की बेहतर सेहत के लिए सही सलाह, सही विशेषज्ञ और सही देखभाल।</p>
      <p class="hero-lead">A calmer way to find the right eye specialist for your concern, with compassionate care at Jain Eye Hospital &amp; Laser Centre.</p>
      <div class="hero-ctas">
        <a class="btn btn-primary" href="/find-an-eye-doctor">Find your specialist <span aria-hidden="true">→</span></a>
        <a class="btn btn-outline light" href="/book-appointment">Book a consultation</a>
      </div>
      <div class="hero-trust-row">
        <span><b>Care</b> patient-first approach</span>
        <span><b>Clear</b> next-step guidance</span>
        <span><b>Delhi</b> specialist care</span>
      </div>
    </div>
    <div class="hero-gallery" aria-label="Jain Eye Hospital care and facilities">
      <div class="hero-gallery-glass" aria-hidden="true"></div>
      <div class="hero-gallery-main">
        <img src="<?= e($homeImages['team']) ?>" alt="Eye-care clinician in a hospital consultation area" width="680" height="520" fetchpriority="high">
        <span class="hero-photo-label">Specialist-led care</span>
      </div>
      <div class="hero-gallery-tile hero-gallery-tile-one">
        <img src="<?= e($homeImages['clinic']) ?>" alt="Jain Eye Hospital reception" loading="lazy" width="300" height="220">
        <span>Welcome, always</span>
      </div>
      <div class="hero-gallery-tile hero-gallery-tile-two">
        <img src="<?= e($homeImages['care']) ?>" alt="Shalimar Bagh Metro station entrance" loading="lazy" width="300" height="220">
        <span>Nearby metro access</span>
      </div>
      <div class="hero-gallery-tile hero-gallery-tile-four">
        <img src="<?= e($homeImages['hero']) ?>" alt="Jain Eye Hospital waiting area" loading="lazy" width="300" height="220">
        <span>Comfortable spaces</span>
      </div>
      <div class="hero-gallery-badge"><strong>देखभाल</strong><span>with clarity</span></div>
    </div>
  </div>
  <div class="hero-proof wrap"><span>Guidance, not rankings</span><span>Verified care pathways</span><span>Shalimar Bagh, Delhi</span></div>
</section>

<!-- 2. Quick concern navigator -->
<section class="section concern-section concern-redesign" id="concern-section">
  <div class="wrap">
    <div class="concern-panel">
      <div class="concern-intro">
        <p class="eyebrow">Start with what you know</p>
        <h2>What brings you here <em>today?</em></h2>
        <p>Choose the closest concern and we’ll help you understand the right starting point. No diagnosis — just clearer next steps.</p>
        <a class="concern-guide-link" href="/find-an-eye-doctor">Not sure? Find a specialist <b>→</b></a>
      </div>
      <div class="concern-list">
        <?php foreach (CONCERN_QUICK as $i => [$id, $label, $route]): ?>
          <a class="concern-option" href="<?= e($route) ?>"><span class="concern-option-number"><?= sprintf('%02d', $i + 1) ?></span><strong><?= e($label) ?></strong><span class="concern-option-arrow">↗</span></a>
        <?php endforeach; ?>
      </div>
      <div class="concern-footnote"><span>Education only</span><span>Clinical examination is needed for personal advice.</span></div>
    </div>
  </div>
</section>

<!-- 3. What best should mean -->
<section class="section mint criteria-section criteria-redesign" id="criteria-section">
  <div class="wrap">
    <div class="criteria-topline">
      <div class="criteria-intro">
        <p class="eyebrow">A better way to choose</p>
        <h2>What “best” should actually mean.</h2>
        <p class="lead">The right specialist is not a universal ranking. It is the right match for your concern, your questions and your care journey.</p>
        <a class="text-link" href="/why-choose-an-eye-specialist">See our selection principles <span>→</span></a>
      </div>
      <div class="criteria-note"><span>01—06</span><strong>Six things that matter<br>before you book.</strong></div>
    </div>
    <ol class="criteria-card-grid">
      <li class="criteria-card"><span class="criteria-number">01</span><span class="criteria-icon" aria-hidden="true">✓</span><strong>Verified qualifications</strong><span>Clear, checkable credentials you can trust.</span></li>
      <li class="criteria-card"><span class="criteria-number">02</span><span class="criteria-icon" aria-hidden="true">◉</span><strong>Relevant sub-speciality</strong><span>The right expertise for the right part of the eye.</span></li>
      <li class="criteria-card"><span class="criteria-number">03</span><span class="criteria-icon" aria-hidden="true">⌕</span><strong>Careful evaluation</strong><span>Examination and context before any recommendation.</span></li>
      <li class="criteria-card"><span class="criteria-number">04</span><span class="criteria-icon" aria-hidden="true">↗</span><strong>Shared decisions</strong><span>Options, expectations and limits explained simply.</span></li>
      <li class="criteria-card"><span class="criteria-number">05</span><span class="criteria-icon" aria-hidden="true">✦</span><strong>Safe infrastructure</strong><span>Diagnostics that help the doctor understand more.</span></li>
      <li class="criteria-card"><span class="criteria-number">06</span><span class="criteria-icon" aria-hidden="true">↻</span><strong>Continuity of care</strong><span>A thoughtful follow-up plan beyond one visit.</span></li>
    </ol>
  </div>
</section>

<!-- 4. Specialist team -->
<section class="section team-section">
  <div class="wrap">
    <div class="section-heading row-heading"><div><p class="eyebrow">Meet the team</p><h2>Specialists who listen first.</h2></div><a class="text-link" href="/doctors">View all doctors <span>→</span></a></div>
    <div class="doctor-layout">
       <div class="team-feature-image"><img src="<?= e($homeImages['team']) ?>" alt="Eye-care clinician in a hospital consultation area" loading="lazy" width="720" height="520"><span class="image-note">A patient-first approach to every consultation</span></div>
      <div class="card-grid team-cards">
      <?php foreach ($doctors as $d): ?>
        <article class="card doctor-card"><div class="doctor-avatar"><?= e(strtoupper(substr($d['name'], 0, 1))) ?></div><h3><?= e($d['name']) ?></h3><p class="muted"><?= e($d['designation']) ?></p><p><?= e($d['focus_areas']) ?></p><div class="card-actions"><a class="btn btn-outline btn-small" href="/doctors/<?= e($d['slug']) ?>">View profile</a><a class="btn btn-primary btn-small" href="/book-appointment?doctor=<?= (int)$d['id'] ?>">Book</a></div></article>
      <?php endforeach; ?>
       <?php if (!$doctors): ?><article class="card empty-card">
         <img src="/public/assets/images/clinical/neha-mohan-4.webp" alt="Eye examination using a slit-lamp instrument" loading="lazy" width="560" height="360">
         <div><span class="status-dot"></span><p class="eyebrow">Doctor profiles</p><h3>Profiles are being verified</h3><p class="muted">Names, credentials and areas of practice are published only after hospital verification. Use the specialist guide to explore a starting point meanwhile.</p><a class="text-link" href="/find-an-eye-doctor">Find a care pathway <span>→</span></a></div>
       </article><?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- 5. Interactive eye-care map -->
<section class="section anatomy-section anatomy-redesign" id="anatomy-section">
  <div class="wrap anatomy-layout">
    <div class="anatomy-visual anatomy-showcase">
      <div class="anatomy-showcase-label"><span>01</span><strong>Know your eye</strong></div>
      <video class="anatomy-video" autoplay muted loop playsinline preload="metadata" poster="/public/assets/images/clinical/eye-care-journey-poster.webp" aria-label="Eye care visual showing the eye and specialist care">
        <source src="/public/assets/videos/eye-care-journey.mp4" type="video/mp4">
      </video>
      <div class="anatomy-video-shade" aria-hidden="true"></div>
      <div class="anatomy-video-caption"><span class="anatomy-play" aria-hidden="true">▶</span><span><b>Understand your eye</b><small>Watch a simple visual guide</small></span></div>
      <div class="anatomy-showcase-footer"><span>Simple education</span><span>Better questions</span></div>
    </div>
    <div class="anatomy-copy">
      <p class="eyebrow">Understand your eye</p>
      <h2>Different concerns need different expertise.</h2>
      <p class="muted">Explore the part of the eye connected with common concerns. This is education, not a diagnosis.</p>
      <div class="eye-map eye-card-grid" id="eyeMap"><?php foreach ([['Cornea / Anterior Segment','Surface disease, infections and scars — cornea specialist.'],['Lens','Cataract and lens-based blur — cataract & lens care.'],['Retina / Vitreous','Flashes, floaters and diabetic eye disease — retina care.'],['Optic Nerve','Glaucoma and nerve health — specialist follow-up.'],['Child Vision','Squint and developing vision — paediatric eye care.']] as [$name,$desc]): ?><button class="eye-region" type="button"><span class="eye-card-dot" aria-hidden="true"></span><strong><?= e($name) ?></strong><span class="eye-card-description"><?= e($desc) ?></span><span class="eye-card-arrow" aria-hidden="true">↗</span></button><?php endforeach; ?></div>
    </div>
  </div>
</section>

<!-- 6. Centres of focused care -->
<section class="section care-section care-redesign" id="care-section">
  <div class="wrap">
    <div class="care-heading-row">
      <div class="section-heading">
        <p class="eyebrow">Focused care</p>
        <h2>Find your care pathway.</h2>
        <p class="muted">Clear starting points for common eye-care questions.</p>
      </div>
      <div class="care-heading-meta"><span>CARE, EXPLAINED</span><strong>Start with what<br>you need today.</strong></div>
    </div>
    <?php $careCardImages = [
      'cataract' => ['/public/assets/images/clinical/precision-ophthalmic-surgery-in-theatre.webp', 'Ophthalmic surgery under an operating microscope'],
      'cornea-and-anterior-segment' => ['/public/assets/images/clinical/neha-mohan-4.webp', 'Eye examination using a slit-lamp instrument'],
      'retina-and-vitreous' => ['/public/assets/images/clinical/hospital-pic-17.webp', 'Ophthalmic diagnostic equipment'],
      'glaucoma' => ['/public/assets/images/clinical/hospital-pic-16.webp', 'Clinical equipment used during eye examinations'],
      'paediatric-ophthalmology' => ['/public/assets/images/clinical/hospital-pic-14.webp', 'An ophthalmic examination room'],
      'lasik-and-refractive-surgery' => ['/public/assets/images/clinical/hospital-pic-10.webp', 'Ophthalmic examination equipment in a clinical room'],
    ]; ?>
    <div class="care-grid"><?php foreach (array_slice(MEGA_MENU, 0, 6) as $i => [$lbl,$slug,$desc]): $cardImage = $careCardImages[$slug] ?? ['/public/assets/images/clinical/neha-mohan-4.webp', 'An ophthalmologist examining a patient with a slit lamp']; ?><a class="care-card" style="--card-index:<?= (int)$i ?>" href="/eye-care/<?= e($slug) ?>">
      <div class="care-image"><img src="<?= e($cardImage[0]) ?>" alt="<?= e($cardImage[1]) ?>" loading="lazy" width="560" height="320"><span class="care-image-shine" aria-hidden="true"></span><span class="care-number">0<?= $i + 1 ?></span></div>
      <div class="care-card-body"><div class="care-card-topline"><span class="care-tag">FOCUSED CARE</span><span class="care-arrow" aria-hidden="true">↗</span></div><h3><?= e($lbl) ?></h3><p><?= e($desc) ?></p><span class="care-link">Understand your options <b>→</b></span></div>
    </a><?php endforeach; ?></div>
  </div>
</section>

<!-- 7. Consultation journey -->
<section class="section journey-section journey-redesign" id="journey-section">
  <div class="journey-backdrop" aria-hidden="true"><img src="<?= e($homeImages['waiting']) ?>" alt="" loading="lazy" width="1600" height="900"></div>
  <div class="journey-overlay" aria-hidden="true"></div>
  <div class="wrap journey-content">
    <div class="journey-heading">
      <div>
        <p class="eyebrow">What to expect</p>
        <h2>Your consultation,<br><em>step by step.</em></h2>
        <p>A clear process helps you arrive prepared and leave with better questions answered.</p>
      </div>
      <div class="journey-heading-badge"><span>YOUR VISIT</span><strong>Simple. Clear.<br>Patient-first.</strong></div>
    </div>
    <ol class="journey journey-card-grid">
      <li style="--journey-index:0"><span class="journey-step">01</span><span class="journey-icon" aria-hidden="true">⌕</span><strong>Choose concern</strong><span>Tell us what brings you in.</span></li>
      <li style="--journey-index:1"><span class="journey-step">02</span><span class="journey-icon" aria-hidden="true">↗</span><strong>Book a visit</strong><span>Find a suitable time to meet.</span></li>
      <li style="--journey-index:2"><span class="journey-step">03</span><span class="journey-icon" aria-hidden="true">▣</span><strong>Bring records</strong><span>Carry reports, glasses and medicines.</span></li>
      <li style="--journey-index:3"><span class="journey-step">04</span><span class="journey-icon" aria-hidden="true">◉</span><strong>Detailed evaluation</strong><span>Understand what the doctor sees.</span></li>
      <li style="--journey-index:4"><span class="journey-step">05</span><span class="journey-icon" aria-hidden="true">✦</span><strong>Explanation &amp; options</strong><span>Ask questions and discuss next steps.</span></li>
      <li style="--journey-index:5"><span class="journey-step">06</span><span class="journey-icon" aria-hidden="true">↻</span><strong>Follow-up plan</strong><span>Leave with a clearer way forward.</span></li>
    </ol>
    <div class="journey-bottom"><p><span>Important:</span> Treatment is never promised before examination.</p><a class="journey-link" href="/patient-guide/first-visit">Prepare for your visit <b>→</b></a></div>
  </div>
</section>

<!-- 8. Technology with context -->
<section class="section technology-section technology-redesign" id="technology-section">
  <div class="wrap technology-layout">
    <div class="technology-copy">
      <p class="eyebrow">Technology with context</p>
      <h2>Good equipment matters.<br><em>Good interpretation matters more.</em></h2>
      <p class="lead">We publish diagnostics only after hospital verification. The important question is always: what does this test help the ophthalmologist understand?</p>
      <div class="tech-points"><span>✓ Diagnostic context</span><span>✓ Patient-friendly explanations</span><span>✓ No machine-logo wall</span></div>
      <a class="btn btn-outline" href="/about">How we work <span>→</span></a>
    </div>
    <div class="technology-visual">
      <div class="technology-image"><img src="<?= e($homeImages['diagnostics']) ?>" alt="Eye-care diagnostic and clinic environment" loading="lazy" width="700" height="480"><span class="technology-image-label">Technology, explained</span></div>
      <div class="technology-stat"><strong>01</strong><span>Question first.<br>Machine second.</span></div>
    </div>
  </div>
</section>

<!-- 9. Patient decision studio -->
<section class="section mint decision-section decision-redesign" id="decision-section">
  <div class="wrap">
    <div class="decision-heading">
      <div>
        <p class="eyebrow">Patient decision studio</p>
        <h2>Make your next visit<br><em>more useful.</em></h2>
        <p>Small preparation can make a big difference to the questions you ask and the clarity you leave with.</p>
      </div>
      <span class="soft-badge">Education only · No diagnosis</span>
    </div>
    <div class="decision-grid">
      <a class="decision-card" style="--decision-index:0" href="/patient-guide/first-visit">
        <div class="decision-card-top"><span class="decision-icon">✦</span><span class="decision-index">01</span></div>
        <div class="decision-card-content"><h3>First-visit checklist</h3><p>Know what to bring, what to expect and how to arrive prepared.</p></div>
        <div class="decision-card-footer"><span>Open guide</span><b>→</b></div>
      </a>
      <a class="decision-card" style="--decision-index:1" href="/second-opinion">
        <div class="decision-card-top"><span class="decision-icon">↗</span><span class="decision-index">02</span></div>
        <div class="decision-card-content"><h3>Second opinion</h3><p>Share reports privately and ask better questions about your options.</p></div>
        <div class="decision-card-footer"><span>Learn more</span><b>→</b></div>
      </a>
      <a class="decision-card" style="--decision-index:2" href="/patient-guide/questions-to-ask">
        <div class="decision-card-top"><span class="decision-icon">?</span><span class="decision-index">03</span></div>
        <div class="decision-card-content"><h3>Question builder</h3><p>Prepare a clearer conversation for your next eye-care visit.</p></div>
        <div class="decision-card-footer"><span>Build your list</span><b>→</b></div>
      </a>
    </div>
    <div class="decision-bottom"><span>Better questions lead to clearer conversations.</span><a href="/book-appointment">Book a consultation <b>→</b></a></div>
  </div>
</section>

<!-- 10. Patient voices, Google reviews and hospital gallery -->
<section class="section trust-section trust-redesign" id="trust-section">
  <div class="wrap">
    <div class="trust-heading">
      <div>
        <p class="eyebrow">Patient voices</p>
        <h2>Trust grows through<br><em>real experiences.</em></h2>
        <p>Good care is personal. We keep every story consent-led, honest and grounded in the patient journey.</p>
      </div>
      <a class="review-link" href="https://www.google.com/search?q=Jain+Eye+Hospital+Laser+Centre+Delhi+reviews" target="_blank" rel="noopener"><span>See Google reviews</span><b>↗</b></a>
    </div>
    <div class="trust-grid">
      <article class="trust-quote-panel">
        <div class="trust-panel-top"><span class="trust-kicker">REAL EXPERIENCES</span><span class="trust-status">Consent-led stories</span></div>
        <?php if ($testimonials): foreach ($testimonials as $t): ?>
          <blockquote class="trust-quote"><span class="quote-mark">“</span><p><?= e($t['content']) ?></p><footer><?= e($t['patient_name']) ?><?= $t['treatment_ref'] ? ' · '.e($t['treatment_ref']) : '' ?></footer></blockquote>
        <?php endforeach; else: ?>
          <div class="trust-empty"><span class="quote-mark">“</span><h3>Every patient story deserves context.</h3><p>We publish patient experiences only when consent and authenticity can be confirmed. While stories are being verified, use these practical resources to prepare for your visit.</p><div class="trust-resource-links"><a href="/patient-guide/first-visit">First-visit checklist <b>→</b></a><a href="/patient-guide/questions-to-ask">Questions to ask <b>→</b></a><a href="/faqs">Appointment FAQs <b>→</b></a></div></div>
        <?php endif; ?>
        <div class="trust-panel-footer"><span>Stories are published only with permission.</span><span class="trust-dots" aria-hidden="true"><i></i><i></i><i></i></span></div>
      </article>
      <?php $trustImages = [$homeImages['team'], $homeImages['waiting'], $homeImages['care'], $homeImages['clinic']]; ?>
      <article class="trust-media-panel">
        <div class="trust-media-head"><span class="social-glyph" aria-hidden="true">◉</span><div><b>Care, explained simply.</b><span>Patient education and hospital spaces</span></div><span class="trust-follow">GALLERY</span></div>
        <div class="instagram-grid"><?php foreach ($trustImages as $i => $image): ?><div class="trust-media-tile"><img src="<?= e($image) ?>" alt="Eye-care and hospital environment photo <?= $i + 1 ?>" loading="lazy" width="420" height="280"><span><?= sprintf('%02d', $i + 1) ?></span></div><?php endforeach; ?></div>
        <div class="trust-media-footer"><span>Four views of eye-care spaces and work</span><a href="/gallery">View photo gallery <b>↗</b></a></div>
      </article>
    </div>
    <div class="trust-proof-strip"><span><b>01</b> Clear explanations</span><span><b>02</b> Respectful conversations</span><span><b>03</b> Care with context</span></div>
  </div>
</section>

<!-- 11. Knowledge hub -->
<section class="section knowledge-section knowledge-redesign" id="knowledge-section">
  <div class="wrap">
    <div class="knowledge-heading">
      <div><p class="eyebrow">Knowledge hub</p><h2>Clear answers for important<br><em>questions.</em></h2><p>Patient-friendly guidance to help you understand your next eye-care conversation.</p></div>
      <a class="knowledge-explore" href="/articles">Explore all guides <b>→</b></a>
    </div>
    <div class="article-grid knowledge-cards">
      <?php if ($articles): foreach ($articles as $i => $a):
        $articleHref = $a['link'] ?? ('/articles/' . rawurlencode($a['slug']));
        $articleImage = $a['image'] ?? '/public/assets/images/clinical/hospital-pic-9.webp';
        $articleAlt = $a['image_alt'] ?? 'A welcoming eye-care clinic environment';
        $isReviewed = !empty($a['reviewer_name']) && !empty($a['reviewed_at']);
      ?>
        <a class="article-card" style="--article-index:<?= (int)$i ?>" href="<?= e($articleHref) ?>">
          <div class="article-card-image"><img src="<?= e($articleImage) ?>" alt="<?= e($articleAlt) ?>" loading="<?= $i < 3 ? 'eager' : 'lazy' ?>" width="560" height="320"></div>
          <div class="article-card-content"><div class="article-card-top"><span class="article-tag"><?= $isReviewed ? 'CLINICALLY REVIEWED' : 'PATIENT EDUCATION' ?></span><span class="article-number"><?= sprintf('%02d', $i + 1) ?></span></div><h3><?= e($a['title']) ?></h3><p><?= e($a['excerpt'] ?? 'Explore this eye-care guide and prepare questions for your next visit.') ?></p><span class="article-read"><?= !empty($a['link']) ? 'Read guide' : 'Read article' ?> <b>→</b></span></div>
        </a>
      <?php endforeach; else: ?>
        <div class="knowledge-empty"><span class="knowledge-empty-icon" aria-hidden="true">✦</span><div><span class="article-tag">PATIENT EDUCATION</span><h3>Guides are being prepared</h3><p>Use the existing concern guides and FAQs while new articles are reviewed.</p></div><a class="article-read" href="/faqs">Browse FAQs <b>→</b></a></div>
      <?php endif; ?>
    </div>
    <div class="knowledge-note"><span>Learn at your pace</span><span>Education only · No diagnosis</span></div>
  </div>
</section>

<!-- 12. Location, booking and final reassurance -->
<section class="section location-final location-redesign" id="location-section">
  <div class="wrap">
    <div class="location-heading"><div><p class="eyebrow">Visit Jain Eye Hospital</p><h2>Easy to find.<br><em>Easier to ask for help.</em></h2></div><span>Delhi · Shalimar Bagh</span></div>
    <div class="location-panel">
      <div class="location-copy">
        <div class="location-address"><span class="location-pin">⌖</span><div><strong><?= e(HOSPITAL_NAME) ?></strong><p><?= e(HOSPITAL_ADDRESS) ?></p></div></div>
        <div class="location-meta"><span>Shalimar Bagh, Delhi</span><span>Timings: verify before visit</span></div>
        <div class="map-embed"><iframe title="Map showing Jain Eye Hospital, Shalimar Bagh, Delhi" loading="lazy" src="https://www.google.com/maps?q=<?= e(rawurlencode(HOSPITAL_ADDRESS)) ?>&amp;output=embed"></iframe></div>
        <a class="text-link" href="/location/adarsh-nagar-delhi">Directions &amp; location details <span>→</span></a>
      </div>
      <form class="mini-form" action="/book-appointment" method="post">
        <span class="form-kicker">QUICK ENQUIRY</span><h3>Not sure which specialist to choose?</h3><p>Tell us your concern. The team can guide your booking.</p><?= Csrf::field() ?><input type="text" name="website" class="hp" tabindex="-1" autocomplete="off">
        <div class="form-two-col"><label>Patient name <input required name="patient_name" autocomplete="name" placeholder="Your name"></label><label>Phone <input required name="phone" inputmode="tel" autocomplete="tel" placeholder="Your phone number"></label></div>
        <label>Age band <select name="age_band"><?php foreach (AGE_BANDS as $b): ?><option><?= e($b) ?></option><?php endforeach; ?></select></label>
        <label>Concern <input name="concern" placeholder="What would you like help with?"></label>
        <label class="consent"><input type="checkbox" name="consent" required> I agree to be contacted about this request.</label><button class="btn btn-primary" type="submit">Request a call back <span>→</span></button><p class="microcopy">Your appointment is confirmed only after the hospital contacts you.</p>
      </form>
    </div>
  </div>
</section>
