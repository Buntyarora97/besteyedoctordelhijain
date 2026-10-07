
<?php $ok = $_GET['ok'] ?? ''; $err = flash('form_errors');
$selDoc = (int)($_GET['doctor'] ?? 0); ?>
<section class="page-hero"><div class="wrap">
  <h1>Book an Eye Consultation</h1>
  <p class="lead">Request an appointment with the right specialist at Jain Eye Hospital &amp; Laser Centre, Shalimar Bagh.</p>
</div></section>
<section class="section"><div class="wrap form-with-aside">
  <aside class="form-aside">
    <figure class="form-aside-image">
      <img src="/public/assets/images/clinical/hospital-pic-14.webp" alt="An eye examination room prepared for a patient visit" width="720" height="480" loading="lazy">
      <figcaption>Eye-care facilities · illustrative photo</figcaption>
    </figure>
    <div class="form-aside-copy">
      <p class="eyebrow">Plan your appointment request</p>
      <h2>A few details help the team respond.</h2>
      <p>Share your main concern and preferred timing. You can bring previous prescriptions, reports and current glasses to your visit instead of adding sensitive details here.</p>
      <a class="text-link" href="/patient-guide/first-visit">See the first-visit checklist <b aria-hidden="true">→</b></a>
    </div>
  </aside>
  <div class="form-panel">
  <?php if ($ok): ?><p class="success">Your request has been received — Reference <strong><?= e($ok) ?></strong>. The appointment is confirmed only after the hospital contacts you.</p><?php endif; ?>
  <?php if ($err): ?><p class="error" role="alert"><?= e($err) ?></p><?php endif; ?>
  <form action="/book-appointment" method="post" class="form">
    <?= Csrf::field() ?>
    <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off">
    <label>Patient name <input required name="patient_name" autocomplete="name"></label>
    <label>Age band <select name="age_band" required><?php foreach (AGE_BANDS as $b): ?><option><?= $b ?></option><?php endforeach; ?></select></label>
    <label>Phone <input required name="phone" inputmode="tel" autocomplete="tel"></label>
    <label>Email (optional) <input type="email" name="email" autocomplete="email"></label>
    <label>Preferred doctor <select name="doctor_id">
      <option value="">Help me choose</option>
      <?php foreach ($doctors as $d): ?><option value="<?= (int)$d['id'] ?>" <?= $selDoc === (int)$d['id'] ? 'selected' : '' ?>><?= e($d['name']) ?></option><?php endforeach; ?>
    </select></label>
    <label>Concern category <input name="concern"></label>
    <label>Preferred date <input type="date" name="preferred_date"></label>
    <label>Time preference <input name="time_preference" placeholder="e.g. morning"></label>
    <label class="consent"><input type="checkbox" name="existing_patient"> I am an existing patient</label>
    <label>Message <textarea name="message" rows="4"></textarea></label>
    <label class="consent"><input type="checkbox" name="consent" required> I consent to be contacted about this request.</label>
    <button class="btn btn-primary" type="submit">Request Appointment</button>
    <p class="microcopy">We never ask for Aadhaar or detailed medical history in this form.</p>
  </form>
  </div>
</div></section>
