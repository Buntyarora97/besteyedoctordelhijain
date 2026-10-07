
<?php $ok = $_GET['ok'] ?? ''; $err = flash('form_errors');
$selDoc = (int)($_GET['doctor'] ?? 0); ?>
<section class="page-hero"><div class="wrap">
  <h1>Book an Eye Consultation</h1>
  <p class="lead">Request an appointment with the right specialist at Jain Eye Hospital &amp; Laser Centre, Shalimar Bagh.</p>
</div></section>
<section class="section"><div class="wrap narrow">
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
</div></section>
