<?php /* Exactly 8 primary sections per master prompt */ ?>
<section class="page-hero"><div class="wrap">
  <h1>About this website</h1>
  <p class="lead">A patient-first specialist-discovery website associated with Jain Eye Hospital &amp; Laser Centre, Delhi.</p>
</div></section>

<section class="section about-feature" aria-labelledby="about-feature-heading">
  <div class="wrap about-feature-layout">
    <figure class="about-feature-image">
      <img src="/public/assets/images/clinical/hospital-pic-8.webp" alt="Patient reception desk inside the eye hospital" width="800" height="500" loading="lazy">
      <figcaption>Clear information for each step of your visit</figcaption>
    </figure>
    <div class="about-feature-copy">
      <p class="eyebrow">A clearer starting point</p>
      <h2 id="about-feature-heading">Guidance first. Personal care in the clinic.</h2>
      <p>This website helps you understand eye-care pathways, prepare questions and find hospital contact information. It does not rank doctors or replace a professional examination.</p>
      <div class="about-feature-points"><span><b>01</b> Start with a concern</span><span><b>02</b> Learn which questions to ask</span><span><b>03</b> Confirm your next step with the hospital</span></div>
      <a class="text-link" href="/find-an-eye-doctor">Explore the specialist guide <b aria-hidden="true">→</b></a>
    </div>
  </div>
</section>

<section class="section"><div class="wrap prose">
  <h2>1. Why this website exists</h2>
  <p>Searching "best eye doctor in Delhi" returns rankings nobody can verify. This website replaces that noise with something better: a structured way to match your concern to the right sub-specialist. We translate "best" into measurable criteria — verified qualifications, relevant sub-speciality, careful diagnosis, clear communication, suitable infrastructure, responsible treatment planning and continuity of care. We are not an official ranking site and never claim any individual is objectively Delhi's number one.</p>
</div></section>

<section class="section mint"><div class="wrap prose">
  <h2>2. Our connection to Jain Eye Hospital</h2>
  <p>We are associated with Jain Eye Hospital &amp; Laser Centre at <?= e(HOSPITAL_ADDRESS) ?>. This site helps patients discover and reach the hospital's eye specialists. It is not the hospital's official institutional website — the official domain owns full facility and department information; this site owns specialist discovery, symptom-to-specialist guidance and patient education.</p>
</div></section>

<section class="section"><div class="wrap prose">
  <h2>3. Care philosophy: listen, examine, explain, decide together</h2>
  <p>Good eye care is a conversation before it is a procedure. We believe in listening to the whole story, examining carefully, explaining findings in plain language, and letting patients decide on their own timeline. No fear marketing, no fake urgency, no guaranteed outcomes. Treatment is recommended only when examination supports it — and is never promised before that examination.</p>
</div></section>

<section class="section mint"><div class="wrap prose">
  <h2>4. The sub-speciality model and referral logic</h2>
  <p>An eye is not one organ problem. The front (cornea, lens) and the back (retina, optic nerve) need different specialists, and children need yet another approach. Our find-an-eye-doctor logic routes each concern to the appropriate sub-speciality, and when a case crosses boundaries, the team refers internally so the patient moves between specialists without starting over.</p>
</div></section>

<section class="section"><div class="wrap prose">
  <h2>5. Quality, safety, consent and responsible claims</h2>
  <p>Every doctor credential, technology name, price, accreditation and testimonial on this site carries a verification flag in our admin system, and nothing unverified is published. We do not use "100% success", "permanent cure", "zero risk" or invented awards. Consent is explicit wherever patient images or reports are involved, and medical reports shared for second opinions are stored privately — never as public URLs.</p>
</div></section>

<section class="section mint"><div class="wrap prose">
  <h2>6. Patient journey and continuity of care</h2>
  <p>From first contact to follow-up, the path is designed: choose a concern, book, bring records, be examined, hear your options, receive treatment only if appropriate, and follow up. Eye care is a course, not an event — follow-up continuity is one of our seven selection criteria because it is where outcomes are actually protected.</p>
</div></section>

<section class="section"><div class="wrap prose">
  <h2>7. Community education and our content commitment</h2>
  <p>Our articles, FAQs and guides are written in plain language, reviewed by the clinical team before publication, and carry review dates. General educational explanations draw on reputable clinical sources, while anything specific to the hospital or its doctors is published only from hospital-approved material. We link to the deeper related domains — the doctors' personal sites and the LASIK-focused domain — rather than duplicating their content.</p>
</div></section>

<section class="section mint"><div class="wrap split">
  <div>
    <h2>8. Location, accessibility and contact</h2>
    <p><?= e(HOSPITAL_ADDRESS) ?></p>
    <p>Email: <a href="mailto:<?= e(HOSPITAL_EMAIL) ?>"><?= e(HOSPITAL_EMAIL) ?></a>.</p>
    <a class="btn btn-primary" href="/book-appointment">Book an Eye Consultation</a>
  </div>
  <div>
    <h3>Accessibility</h3>
    <p>We aim for WCAG-contrast design, keyboard-accessible menus and forms, reduced-motion support and screen-reader alternatives for interactive modules. Feedback is welcome via the contact page.</p>
  </div>
</div></section>
