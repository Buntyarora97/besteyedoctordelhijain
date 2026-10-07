
<section class="page-hero"><div class="wrap"><h1><?= e(ucwords(str_replace('-', ' ', $which))) ?></h1></div></section>
<section class="section"><div class="wrap prose">
<?php if ($which === 'why-choose-an-eye-specialist'): ?>
  <h2>The short answer</h2>
  <p>Because eyes are not one organ problem. A cornea ulcer, a retinal detachment and a child's squint need three different specialists, and the wrong first stop costs weeks. Choosing a sub-specialist first is the single most efficient decision in eye care.</p>
  <h2>The longer answer</h2>
  <p>Ophthalmology divides into anterior segment (cornea, lens), retina-vitreous, glaucoma, paediatrics, uveitis, oculoplastics and refractive surgery. Each trains years beyond the base degree. Our Find an Eye Doctor guide maps your concern to the right sub-speciality in five questions — guiding, never diagnosing.</p>
  <p><a class="btn btn-primary" href="/find-an-eye-doctor">Use the Guide</a></p>
<?php elseif ($which === 'videos'): ?>
  <p>Doctor videos are published only after clinical review and patient-consent verification. Check back shortly.</p>
<?php else: ?>
  <p>This section is being prepared with verified hospital material. Unverified images are never published.</p>
<?php endif; ?>
</div></section>
