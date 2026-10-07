
<?php $ok = $_GET['ok'] ?? ''; $err = flash('form_errors'); ?>
<section class="page-hero"><div class="wrap">
  <h1>Second Opinion on Eye Treatment</h1>
  <p class="lead">Share your current diagnosis and reports. The clinical team reviews and guides you — privately.</p>
</div></section>
<section class="section"><div class="wrap narrow">
  <?php if ($ok): ?><p class="success">Request received — Reference <strong><?= e($ok) ?></strong>. The team will contact you after review.</p><?php endif; ?>
  <?php if ($err): ?><p class="error" role="alert"><?= e($err) ?></p><?php endif; ?>
  <form action="/second-opinion" method="post" enctype="multipart/form-data" class="form">
    <?= Csrf::field() ?>
    <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off">
    <label>Your name <input required name="name" autocomplete="name"></label>
    <label>Phone <input required name="phone" inputmode="tel"></label>
    <label>Email (optional) <input type="email" name="email"></label>
    <label>Current diagnosis (as told to you) <input name="current_diagnosis"></label>
    <label>Your question <textarea name="question" rows="4"></textarea></label>
    <label>Reports (PDF/JPG/PNG, max 5 MB) <input type="file" name="report" accept=".pdf,.jpg,.jpeg,.png"></label>
    <label class="consent"><input type="checkbox" name="consent" required> I consent to privately sharing my reports for a second opinion. Reports are stored securely outside public access and are never emailed as attachments.</label>
    <button class="btn btn-primary" type="submit">Request Second Opinion</button>
    <p class="microcopy">Retention: reports are kept only as long as needed for your review, then deleted on request.</p>
  </form>
</div></section>
