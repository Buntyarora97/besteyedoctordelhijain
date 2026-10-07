<?php
$viewFile = dirname(__DIR__) . '/pages/' . $view . '.php';
if (!file_exists($viewFile)) $viewFile = dirname(__DIR__) . '/errors/404.php';
$phoneHref = preg_replace('/[^0-9+]/', '', HOSPITAL_PHONE);
$metaImageUrl = APP_URL . ($metaImage ?? '/public/assets/images/clinical/neha-mohan-4.webp');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle ?? 'Eye Specialist Guidance in Delhi') ?></title>
<meta name="description" content="<?= e($metaDescription ?? '') ?>">
<meta name="keywords" content="<?= e($metaKeywords ?? '') ?>">
<meta name="robots" content="index,follow,max-image-preview:large">
<meta name="author" content="<?= e(HOSPITAL_NAME) ?>">
<meta name="theme-color" content="#0d4037">
<link rel="canonical" href="<?= e($canonical ?? APP_URL) ?>">
<meta property="og:title" content="<?= e($pageTitle ?? '') ?>">
<meta property="og:description" content="<?= e($metaDescription ?? '') ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= e($canonical ?? APP_URL) ?>">
<meta property="og:site_name" content="<?= e(HOSPITAL_NAME) ?>">
<meta property="og:locale" content="en_IN">
<meta property="og:image" content="<?= e($metaImageUrl) ?>">
<meta property="og:image:alt" content="Eye examination at Jain Eye Hospital, Delhi">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($pageTitle ?? '') ?>">
<meta name="twitter:description" content="<?= e($metaDescription ?? '') ?>">
<meta name="twitter:image" content="<?= e($metaImageUrl) ?>">
<link rel="icon" href="/public/assets/images/favicon.svg" type="image/svg+xml">
<link rel="stylesheet" href="/public/assets/css/style.css">
<script type="application/ld+json">
<?= json_encode($schemaGraph ?? [], JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>
</script>
</head>
<?php $bodyRoute = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/'; ?>
<?php
$bodyClasses = [];
if ($bodyRoute === '/gallery') $bodyClasses[] = 'gallery-route';
if (in_array($bodyRoute, ['/contact', '/book-appointment', '/second-opinion', '/location/adarsh-nagar-delhi'], true)) $bodyClasses[] = 'form-route';
?>
<body<?= $bodyClasses ? ' class="' . e(implode(' ', $bodyClasses)) . '"' : '' ?>>
<a class="skip" href="#main">Skip to content</a>

<div class="utility-bar">
  <div class="wrap util-inner">
    <span class="utility-contact-desktop"><?= e(implode(' · ', HOSPITAL_PHONES)) ?> &middot; <a href="mailto:<?= e(HOSPITAL_EMAIL) ?>"><?= e(HOSPITAL_EMAIL) ?></a></span>
    <span class="utility-contact-mobile"><?= e(HOSPITAL_PHONE) ?></span>
    <span>Shalimar Bagh, Delhi</span>
    <a href="/book-appointment" class="util-cta">Book Consultation</a>
  </div>
</div>

<header class="site-header" id="siteHeader">
  <div class="wrap header-inner">
    <a href="/" class="brand" aria-label="Jain Eye Hospital home">
      <img class="header-logo" src="/public/assets/images/jain-eye-hospital-logo.webp" alt="Jain Eye Hospital &amp; Laser Centre" width="176" height="54">
      <span class="brand-context"><strong>Delhi Vision Compass</strong><small>Specialist guidance</small></span>
    </a>
    <nav class="main-nav" id="mainNav" aria-label="Main">
      <ul>
      <?php foreach (SITE_NAV as [$href, $label]):
        $mega = $label === 'Treatments'; ?>
        <li class="<?= $mega ? 'has-mega' : '' ?>">
          <a href="<?= e($href) ?>" <?= $mega ? 'aria-haspopup="true"' : '' ?>><?= e($label) ?></a>
          <?php if ($mega): ?>
          <div class="mega" role="menu">
            <div class="mega-list">
              <?php foreach (MEGA_MENU as [$lbl, $slug, $desc, $spec]): ?>
                <a href="/eye-care/<?= e($slug) ?>" class="mega-item" data-slug="<?= e($slug) ?>">
                  <strong><?= e($lbl) ?></strong><span><?= e($desc) ?></span>
                </a>
              <?php endforeach; ?>
            </div>
            <div class="mega-preview" id="megaPreview">
              <img src="/public/assets/images/compass-icon.svg" alt="" width="240" height="160">
              <p>Every condition has the right sub-specialist. Choose a speciality to begin.</p>
            </div>
          </div>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
      </ul>
    </nav>
      <div class="header-actions">
      <button class="icon-btn" id="searchBtn" aria-label="Search">⌕ <span>Search</span></button>
      <a class="btn btn-ghost" href="tel:<?= e($phoneHref) ?>">Call</a>
      <a class="btn btn-primary" href="/book-appointment">Book consultation</a>
    </div>
    <button class="menu-toggle" id="menuToggle" aria-label="Open menu">Menu</button>
  </div>
</header>

<div class="search-overlay" id="searchOverlay" hidden>
  <div class="search-box">
    <div class="search-row">
      <input type="search" id="globalSearch" placeholder="Search doctors, concerns, treatments, FAQs..." aria-label="Search the site">
      <button id="searchClose" aria-label="Close search">Close</button>
    </div>
    <div id="searchResults" class="search-results"></div>
  </div>
</div>

<main id="main">
<?php require $viewFile; ?>
</main>

<footer class="site-footer footer-redesign" id="siteFooter">
  <div class="footer-backdrop" aria-hidden="true"><img src="/public/assets/images/clinical/hospital-pic-13.webp" alt=""></div>
  <div class="footer-overlay" aria-hidden="true"></div>
  <div class="wrap footer-intro"><div><p class="footer-kicker">JAIN EYE HOSPITAL &amp; LASER CENTRE</p><h2>Clearer care starts<br>with a better question.</h2></div><a class="footer-cta" href="/book-appointment">Book a consultation <b>→</b></a></div>
  <div class="wrap footer-grid">
    <div class="footer-brand">
      <strong><?= e(HOSPITAL_NAME) ?></strong>
      <p><?= e(HOSPITAL_ADDRESS) ?></p>
      <p>Email: <a href="mailto:<?= e(HOSPITAL_EMAIL) ?>"><?= e(HOSPITAL_EMAIL) ?></a></p>
      <p class="microcopy">Associated specialist-discovery website. Not the official hospital domain.</p>
    </div>
    <nav aria-label="Explore"><strong>Explore</strong>
      <a href="/find-an-eye-doctor">Find an Eye Doctor</a>
      <a href="/doctors">Doctors</a>
      <a href="/eye-concerns/blurry-vision">Eye Concerns</a>
      <a href="/articles">Knowledge Hub</a>
    </nav>
    <nav aria-label="Patient guide"><strong>Patients</strong>
      <a href="/book-appointment">Book Appointment</a>
      <a href="/second-opinion">Second Opinion</a>
      <a href="/patient-guide/emergency-eye-symptoms">Emergency Symptoms</a>
      <a href="/faqs">FAQs</a>
    </nav>
    <nav aria-label="Legal"><strong>Trust</strong>
      <a href="/about">About</a>
      <a href="/privacy-policy">Privacy Policy</a>
      <a href="/medical-disclaimer">Medical Disclaimer</a>
      <a href="/sitemap">Sitemap</a>
    </nav>
  </div>
  <div class="wrap footer-legal">
    <p>This is a specialist-discovery website associated with <?= e(HOSPITAL_NAME) ?>. It does not provide diagnosis; content is educational and reviewed before publication.</p>
    <p>Emergency: sudden vision loss, flashes, severe pain or eye injury may need urgent assessment — call the hospital.</p>
  </div>
</footer>

<aside class="social-rail" aria-label="Quick contact links">
  <a href="/gallery" aria-label="View hospital gallery" title="View gallery">▧</a>
  <a href="/faqs" aria-label="Read frequently asked questions" title="FAQs">?</a>
  <a href="mailto:<?= e(HOSPITAL_EMAIL) ?>" aria-label="Email the hospital" title="Email">✉</a>
  <a href="/contact" aria-label="Open contact details" title="Contact">↗</a>
  <a href="tel:<?= e($phoneHref) ?>" aria-label="Call hospital" title="Call hospital">⌕</a>
</aside>

<button class="enquiry-fab" id="enquiryOpen" type="button" aria-haspopup="dialog" aria-controls="enquiryDialog">
  <span class="enquiry-fab-icon">↗</span><span>Enquire now</span>
</button>

<div class="enquiry-dialog" id="enquiryDialog" hidden>
  <div class="dialog-backdrop" data-dialog-close></div>
  <section class="dialog-card" role="dialog" aria-modal="true" aria-labelledby="dialogTitle">
    <button class="dialog-close" id="enquiryClose" type="button" aria-label="Close enquiry form">×</button>
    <span class="form-kicker">QUICK ENQUIRY</span>
    <h2 id="dialogTitle">How can we guide you?</h2>
    <p class="muted">Share your contact details and the team can help you choose the right next step.</p>
    <form action="/contact" method="post" class="form compact-form">
      <?= Csrf::field() ?>
      <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off">
      <label>Your name <input required name="name" autocomplete="name" placeholder="Enter your name"></label>
      <label>Phone number <input required name="phone" inputmode="tel" autocomplete="tel" placeholder="Enter your phone number"></label>
      <label>What do you need help with? <textarea required name="message" rows="3" placeholder="Tell us briefly about your concern"></textarea></label>
      <input type="hidden" name="subject" value="Website quick enquiry">
      <button class="btn btn-primary" type="submit">Send enquiry <span>→</span></button>
      <p class="microcopy">We will contact you about this request. This form does not provide a diagnosis.</p>
    </form>
  </section>
</div>

<nav class="mobile-bar" aria-label="Quick actions">
  <a href="tel:<?= e($phoneHref) ?>">Call</a>
  <button type="button" id="mobileEnquiryOpen" aria-haspopup="dialog" aria-controls="enquiryDialog">Enquire</button>
  <a href="/find-an-eye-doctor">Find Specialist</a>
  <a href="/book-appointment" class="primary">Book</a>
</nav>

<script src="/public/assets/js/main.js" defer></script>
</body>
</html>
