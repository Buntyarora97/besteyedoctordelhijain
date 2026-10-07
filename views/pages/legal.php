
<section class="page-hero"><div class="wrap"><h1><?= e(ucwords(str_replace('-', ' ', $which))) ?></h1></div></section>
<section class="section"><div class="wrap prose">
<?php if ($which === 'privacy-policy'): ?>
  <h2>What we collect</h2>
  <p>Only what each form needs: appointment requests (name, age band, phone, optional email, concern, preferred timing), enquiries, and — only with explicit consent — second-opinion reports.</p>
  <h2>How we use it</h2>
  <p>To respond to your request and coordinate care at Jain Eye Hospital. We do not sell data, and we do not place sensitive values in URLs, analytics or logs.</p>
  <h2>Storage &amp; retention</h2>
  <p>Reports are stored outside publicly accessible paths with random filenames, accessible only to authenticated admins. Data is kept only as long as needed for your care and deleted on request.</p>
  <h2>Your rights</h2>
  <p>Ask us to view, correct or delete your data any time via <a href="mailto:<?= e(HOSPITAL_EMAIL) ?>"><?= e(HOSPITAL_EMAIL) ?></a>.</p>
<?php elseif ($which === 'terms'): ?>
  <h2>Website role</h2>
  <p>This website provides specialist-discovery and education in association with Jain Eye Hospital &amp; Laser Centre. It is not the hospital's official institutional website.</p>
  <h2>No medical advice</h2>
  <p>Content is educational. Appointments are confirmed only after the hospital contacts you. Never delay urgent care because of anything read here.</p>
  <h2>Content accuracy</h2>
  <p>We verify credentials and claims before publication; unverified items remain unpublished. If you spot an error, tell us.</p>
<?php elseif ($which === 'medical-disclaimer'): ?>
  <h2>Education, not diagnosis</h2>
  <p>Nothing on this website diagnoses a condition or replaces an eye examination. Symptom guides help you choose the right specialist — they do not tell you what you have.</p>
  <h2>Emergencies</h2>
  <p>Sudden vision loss, flashes, severe pain or eye injury may need urgent assessment. Call the hospital immediately.</p>
<?php elseif ($which === 'accessibility'): ?>
  <h2>Our commitment</h2>
  <p>We aim for WCAG contrast, keyboard-accessible navigation and forms, reduced-motion support, 44px touch targets and screen-reader alternatives for interactive modules. Feedback via the contact page is welcome.</p>
<?php elseif ($which === 'sitemap'): ?>
  <h2>Pages</h2>
  <ul>
    <?php foreach (PageController::sitemapPaths() as $p): ?><li><a href="/<?= e($p) ?>"><?= e('/' . $p) ?></a></li><?php endforeach; ?>
    <?php foreach (SITE_NAV as [$href, $label]): ?><li><a href="<?= e($href) ?>"><?= e($label) ?></a></li><?php endforeach; ?>
  </ul>
<?php endif; ?>
</div></section>
