
<?php $ok = $_GET['ok'] ?? ''; $err = flash('form_errors'); ?>
<section class="page-hero"><div class="wrap">
  <h1>Contact Us</h1>
  <p class="lead"><?= e(HOSPITAL_NAME) ?> — <?= e(HOSPITAL_ADDRESS) ?></p>
  <p>Email: <a href="mailto:<?= e(HOSPITAL_EMAIL) ?>"><?= e(HOSPITAL_EMAIL) ?></a> &middot; Phone:
    <?php foreach (HOSPITAL_PHONES as $index => $contactPhone): ?>
      <?php if ($index > 0): ?> &middot; <?php endif; ?>
      <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $contactPhone)) ?>"><?= e($contactPhone) ?></a>
    <?php endforeach; ?>
  </p>
</div></section>
<section class="section"><div class="wrap narrow">
  <?php if ($ok): ?><p class="success">Message received — Reference <strong><?= e($ok) ?></strong>. We will get back to you.</p><?php endif; ?>
  <?php if ($err): ?><p class="error" role="alert"><?= e($err) ?></p><?php endif; ?>
  <form action="/contact" method="post" class="form">
    <?= Csrf::field() ?>
    <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off">
    <label>Your name <input required name="name" autocomplete="name"></label>
    <label>Phone <input required name="phone" inputmode="tel"></label>
    <label>Email (optional) <input type="email" name="email"></label>
    <label>Subject <input name="subject"></label>
    <label>Message <textarea required name="message" rows="5"></textarea></label>
    <button class="btn btn-primary" type="submit">Send Message</button>
  </form>
</div></section>
