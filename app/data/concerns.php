<?php
// Eye concern pages - original, non-diagnostic educational content.
// Rendered via PageController::longform(). Reviewer fields set at publish time.
function concern_pages(): array {
return [
'blurry-vision' => [
 'title' => 'Blurry Vision: Causes, Warning Signs & the Right Specialist',
 'h1' => 'Blurry Vision — Understanding the Cause Before Choosing a Doctor',
 'intro' => 'Blurry vision is one of the most common reasons people search for an eye doctor in Delhi. It is a symptom, not a diagnosis — and the right specialist depends on where the problem actually sits in your eye.',
 'speciality' => 'comprehensive',
 'sections' => [
  ['What blurry vision can mean','Your eye works like a camera: the cornea and lens focus light, and the retina converts it into signals for the brain. Blur can come from the focusing system (cornea, lens), the light-sensing layer (retina), the optic nerve, or even general health conditions such as diabetes or uncontrolled blood pressure.'],
  ['Common, non-alarming causes','The most frequent causes are simple: an outdated glasses prescription, dry eyes, early cataract, or eye strain. These are common and usually straightforward to evaluate.'],
  ['Causes that deserve prompt attention','A sudden blur, blur in one eye only, or blur with other symptoms can point to conditions such as retinal detachment, acute glaucoma, corneal infection, diabetic retinopathy, or optic nerve problems. These need timely specialist assessment — not self-treatment.'],
  ['How an ophthalmologist evaluates blur','Evaluation typically includes vision testing, refraction (glasses power check), slit-lamp examination of the front of the eye, eye pressure measurement, and — when indicated — a dilated retina examination or imaging such as OCT. The examination pattern follows your symptoms, not a fixed package.'],
  ['Questions worth asking','Is my blur due to a focusing problem or something at the back of the eye? Do I need a dilated examination today? What are my options, and what happens if I wait?'],
 ],
 'redflags' => ['Sudden vision loss or a dark curtain/shadow across your vision','Blur with severe eye pain, headache, nausea or halos','Blur after eye injury or chemical exposure','New blur with flashes, many floaters, or distortion of straight lines'],
 'faq' => [
  ['Can staring at screens cause blurry vision?','Yes, screen-related eye strain commonly causes temporary fluctuating blur, usually eased by rest and lubricating drops. Persistent or one-sided blur still deserves an examination.'],
  ['Is blurry vision always cataract?','No. Cataract is common after 50, but blurry vision has many causes from a changed glasses power to retinal conditions. Only an examination can tell.'],
  ['When is blurry vision an emergency?','When it starts suddenly, affects one eye, comes with pain, flashes, floaters, or a curtain-like shadow — seek urgent assessment.'],
  ['Will I need drops that blur my vision at the first visit?','If a dilated retina examination is needed, the drops blur near vision for a few hours. Bring a companion if possible, and avoid driving yourself home.'],
  ['Can diabetes cause blurry vision even with good glasses?','Yes. Diabetes can affect the retina and also cause temporary blur from fluctuating sugar levels. Diabetics need periodic retina screening even without symptoms.'],
 ]],
'sudden-vision-changes' => [
 'title' => 'Sudden Vision Changes: When to Seek Urgent Eye Care in Delhi',
 'h1' => 'Sudden Vision Changes — What They Can Mean and When to Act Fast',
 'intro' => 'A sudden change in vision is the one symptom category where waiting is rarely the right choice. This page explains the common patterns and what to do next.',
 'speciality' => 'retina',
 'sections' => [
  ['Patterns that matter','A sudden drop can be a shadow or veil, a burst of floaters, a field loss to one side, or a general dimming. The pattern you describe helps the specialist judge urgency.'],
  ['Possible causes a specialist considers','Retinal detachment or retinal vascular events, acute angle-closure glaucoma, corneal infection, vitreous haemorrhage (especially in diabetics), and optic nerve events are among the causes a specialist will consider and rule out.'],
  ['Why speed matters','Some causes — notably retinal detachment and acute glaucoma — have better outcomes when treated quickly. This is why sudden changes should trigger a same-day call to the hospital, not a search-and-wait approach.'],
  ['What happens at an urgent visit','Expect a focused history, vision and pressure check, slit-lamp examination and a dilated retina evaluation, sometimes with imaging such as OCT or ultrasound if the view inside is hazy.'],
 ],
 'redflags' => ['Curtain-like shadow or sudden field loss','Sudden shower of floaters or flashes','Severe eye pain with nausea/halos','Sudden blur in a diabetic patient'],
 'faq' => [
  ['Is a sudden floater always an emergency?','A new, sudden increase in floaters — especially with flashes or a shadow — needs same-day retinal evaluation. A single small floater that has been stable for years is less urgent.'],
  ['Can sudden vision loss recover on its own?','Some causes are transient, but assuming recovery without assessment risks permanent loss. Sudden changes warrant urgent professional evaluation.'],
  ['Where should I go in Delhi for sudden vision loss?','Call Jain Eye Hospital & Laser Centre, Shalimar Bagh, immediately, or go to the nearest emergency eye service.'],
 ]],
'flashes-and-floaters' => [
 'title' => 'Flashes and Floaters: When They Are Normal and When They Are Not',
 'h1' => 'Flashes and Floaters — Decoding the Signals From the Back of Your Eye',
 'intro' => 'Most people notice a few floaters at some point. New ones, more of them, or flashes of light are your retina\'s way of asking for a check.',
 'speciality' => 'retina',
 'sections' => [
  ['What floaters actually are','Floaters are tiny shadows cast by the gel (vitreous) inside your eye onto the retina. They drift when you move your eyes and are usually harmless when few and stable.'],
  ['What flashes mean','Flashes without a light source can happen when the vitreous gel tugs on the retina. Occasional brief flashes can occur with age, but new or repeated flashes deserve a retinal examination.'],
  ['The warning pattern','A sudden shower of new floaters, flashes that keep repeating, or a shadow at the edge of vision can indicate a retinal tear or detachment — conditions that are treatable when caught early.'],
  ['Who is at higher risk','People who are highly myopic (minus power), have had eye injury or surgery, have diabetes, or have a family history of retinal detachment should be more alert to new symptoms.'],
  ['The examination','A dilated retina examination lets the specialist see the peripheral retina where tears usually start. Imaging such as OCT may support the evaluation.'],
 ],
 'redflags' => ['Sudden increase in floaters','Repeated flashes of light','A curtain or shadow at the side of vision','Floaters or flashes after an eye injury'],
 'faq' => [
  ['Will floaters disappear with eye drops?','No drops dissolve floaters. Most stable floaters are simply monitored; sudden new ones need examination, not medication.'],
  ['Are flashes always serious?','Not always, but new or persistent flashes need a dilated retinal check to rule out tears.'],
  ['Can floaters be removed?','In selected, visually disabling cases vitrectomy can remove floaters, but it carries surgical risk and is considered only after careful evaluation.'],
 ]],
'red-or-painful-eye' => [
 'title' => 'Red or Painful Eye: Causes, Home Care Limits & Urgent Signs',
 'h1' => 'Red or Painful Eye — When It Is Irritation and When It Is an Emergency',
 'intro' => 'A red eye can be a tired eye — or an infection, inflammation or pressure problem. Pain, light sensitivity and vision change are the lines that separate the two.',
 'speciality' => 'cornea',
 'sections' => [
  ['Common benign causes','Dust, dryness, screen strain and minor irritation commonly cause redness that settles with rest and lubrication.'],
  ['Causes that need a doctor','Conjunctivitis, corneal infection (keratitis), uveitis (internal inflammation) and acute glaucoma all cause redness — but with different accompanying signs. Using over-the-counter steroid drops for a red eye is dangerous and can worsen infections.'],
  ['Reading your symptoms','Mild redness without pain or vision change is usually low-risk. Pain, light sensitivity, reduced vision, or a halos-and-headache pattern moves the situation into urgent territory.'],
  ['What the examination covers','Vision, pressure, slit-lamp evaluation of the cornea and internal inflammation check are standard. Fluorescein staining may be used to reveal corneal abrasions or infections.'],
 ],
 'redflags' => ['Red eye with severe pain or light sensitivity','Red eye with reduced vision','Red eye with headache, nausea and halos','Chemical splash — rinse immediately and seek emergency care'],
 'faq' => [
  ['Can I use the same drops a friend used for red eye?','No. Red eyes have different causes, and the wrong drops — especially steroids — can seriously worsen some conditions. Get examined first.'],
  ['Is a red eye contagious?','Viral and bacterial conjunctivitis can spread. Good hand hygiene and avoiding shared towels help, but a diagnosis comes from examination.'],
  ['How fast can a corneal infection damage vision?','Rapidly, within days. A painful red eye with vision change is an urgent visit, not a wait-and-watch situation.'],
 ]],
'watery-or-dry-eyes' => [
 'title' => 'Watery or Dry Eyes: Why Tearing and Dryness Happen Together',
 'h1' => 'Watery or Dry Eyes — the Tear-Film Problem That Confuses Everyone',
 'intro' => 'Eyes that water constantly are often dry. It sounds backwards, but the tear film works like a three-layer film of oil, water and mucus — trouble in any layer causes symptoms.',
 'speciality' => 'comprehensive',
 'sections' => [
  ['How the tear film works','A thin oil layer slows evaporation, a water layer nourishes, and a mucus layer spreads the film evenly. Instability in any layer causes burning, grittiness, fluctuating blur — and paradoxically, watering.'],
  ['Common triggers','Screen use (we blink less), air conditioning, Delhi\'s dust and pollution, ageing, certain medicines and autoimmune conditions such as Sjogren\'s syndrome all affect the tear film.'],
  ['When watering is a blockage','If tears stream down your cheek constantly, the drainage pathway (punctum and tear ducts) may be narrow or blocked — a different problem needing a different treatment.'],
  ['Evaluation and management','Examination may include tear-film assessment and meibomian gland evaluation. Management ranges from lubricating drops and lid hygiene to punctal plugs or minor procedures for blocked drainage — decided by cause, not guesswork.'],
 ],
 'redflags' => ['Watering with a painful red eye or discharge','Constant tearing from one eye with swelling near the nose','Dry eyes with joint pain or dry mouth (possible autoimmune cause)'],
 'faq' => [
  ['Can dry eyes cause blurry vision?','Yes — fluctuating blur that improves with blinking is a classic dry-eye sign.'],
  ['Are lubricating drops safe long-term?','Preservative-free lubricants are generally safe for ongoing use; the right type and frequency should be guided by your doctor.'],
  ['Why do my eyes water in wind or AC?','Wind and AC speed tear evaporation; the eye reflexively floods with watery tears that do not stabilise the film.'],
 ]],
'poor-night-vision' => [
 'title' => 'Poor Night Vision: Halos, Glare and Trouble Driving After Dark',
 'h1' => 'Poor Night Vision — Halos, Glare and What They May Indicate',
 'intro' => 'Struggling to drive at night, seeing halos around lights, or needing more contrast than others are useful clues about your eyes — and some causes are very treatable.',
 'speciality' => 'comprehensive',
 'sections' => [
  ['Common causes','Early cataract is the classic cause of night-time glare and halos. Uncorrected astigmatism, higher-order optical aberrations, dry eye and vitamin A deficiency (uncommon but real) also affect night vision.'],
  ['Less common but important','Retinitis pigmentosa and other retinal conditions first show up as night blindness, often from younger age and sometimes with family history.'],
  ['The evaluation','Refraction under dim light, slit-lamp lens assessment, and a retina examination cover the usual suspects. Specific electrophysiological tests are added only when the pattern suggests a retinal cause.'],
 ],
 'redflags' => ['Night blindness from childhood or teenage years','Night vision problems with tunnel-like side-vision loss'],
 'faq' => [
  ['Do halos around lights always mean cataract?','No — astigmatism, dry eye and even some normal optical effects cause halos. But new or worsening halos after 50 deserve a lens evaluation.'],
  ['Can night vision improve after treatment?','Yes, when the cause is correctable: cataract surgery, updated glasses, or treating dry eye often dramatically improve night vision.'],
 ]],
'diabetes-and-eye-health' => [
 'title' => 'Diabetes and Eye Health: Why Annual Retina Screening Matters',
 'h1' => 'Diabetes and Eye Health — Protecting Your Retina Before Symptoms Start',
 'intro' => 'Diabetic eye disease often has no symptoms until it is advanced. That is exactly why screening — not waiting — is the strategy.',
 'speciality' => 'retina',
 'sections' => [
  ['What diabetes does to the eye','Persistently high sugar damages the small retinal vessels, causing leakage (diabetic macular oedema), blockages (retinopathy) and fragile new vessels that can bleed into the eye.'],
  ['The silent phase','Retinopathy typically causes no pain and little blur in its early, most treatable stages. Vision drops when the macula swells or bleeding occurs — later than ideal.'],
  ['Screening rhythm','Most guidelines recommend a dilated retina examination at least annually for people with diabetes, more often if retinopathy already exists. Pregnancy with diabetes needs closer review.'],
  ['Treatment when needed','Good sugar, blood-pressure and lipid control is the foundation. When retinopathy progresses, laser photocoagulation, anti-VEGF injections or vitrectomy surgery are used at the right stage.'],
 ],
 'redflags' => ['Sudden blur or floaters in a diabetic patient','Vision that fluctuates with sugar levels plus any fixed blur'],
 'faq' => [
  ['My vision is fine — do I still need a retina check?','Yes. Early diabetic retinopathy is detected only by examination; waiting for symptoms means waiting for damage.'],
  ['Can diabetic eye disease be cured?','It can usually be controlled and vision protected, especially when caught early. Advanced disease limits outcomes — another reason for regular screening.'],
  ['Do I need screening if my sugar is now controlled?','Yes. Past high sugar already affects vessels, and screening continues regardless of current control.'],
 ]],
'child-eye-problems' => [
 'title' => 'Child Eye Problems: Squint, Lazy Eye and Screen Strain in Children',
 'h1' => 'Child Eye Problems — What Parents Should Watch For',
 'intro' => 'Children rarely complain about vision problems because they do not know what normal looks like. Watching behaviour is the parent\'s best screening tool.',
 'speciality' => 'paediatric',
 'sections' => [
  ['Signs worth noticing','Sitting very close to the TV, squinting, tilting the head, frequent eye rubbing, a white reflex in photographs, one eye drifting, or a sudden drop in school performance can all signal vision issues.'],
  ['The big three in children','Refractive error (glasses need), amblyopia (lazy eye — the brain under-uses one eye) and squint are the most common. Amblyopia treatment works best when started young, which is why early checks matter.'],
  ['Screens and children','Excessive near work is linked to rising myopia. Outdoor play time and regular distance breaks are practical protective habits.'],
  ['The child eye examination','Paediatric examination is adapted to age: picture-based vision charts, objective refraction (often with cycloplegic drops for accuracy) and a squint/alignment assessment.'],
 ],
 'redflags' => ['White reflex in a child\'s pupil in photos','A sudden squint after illness or head injury','Child reporting double vision or persistent headache with near work'],
 'faq' => [
  ['At what age should a child have a first eye check?','A routine check around age 3–4 (earlier if you notice any sign) lets amblyopia be treated in its most effective window.'],
  ['Will my child outgrow a squint?','No — squint needs evaluation. Some apparent squints in infants resolve, but a persistent squint after 6 months of age should be examined.'],
  ['Are glasses harmful for children?','No. Correctly prescribed glasses support visual development; avoiding them can allow lazy eye to set in.'],
 ]],
'squint' => [
 'title' => 'Squint (Strabismus): Causes and Treatment Options for Children & Adults',
 'h1' => 'Squint — When the Eyes Do Not Point Together',
 'intro' => 'A squint is more than a cosmetic concern: in children it can stop the brain from developing normal vision in the turned eye.',
 'speciality' => 'paediatric',
 'sections' => [
  ['What a squint does','When the eyes are misaligned, each sends a different image to the brain. In children the brain may suppress one image, causing amblyopia (lazy eye); in adults, new squint usually causes double vision.'],
  ['Causes','Childhood squint relates to focusing effort, refractive error or nerve-muscle control. Adult-onset squint can follow nerve palsy, injury, thyroid eye disease or decompensation of a childhood tendency.'],
  ['Treatment ladder','Glasses for any refractive cause are step one. Patching or atropine drops treat associated lazy eye. Eye-muscle surgery aligns the eyes when appropriate; timing matters most in children.'],
  ['Adult squint','Adults with double vision need evaluation for underlying causes; many acquired squints can be improved with prisms, botulinum toxin or surgery.'],
 ],
 'redflags' => ['Sudden squint with double vision in an adult','Squint following head injury'],
 'faq' => [
  ['Does squint surgery improve vision?','Surgery aligns the eyes; vision itself improves when lazy eye is treated with glasses/patching. Both goals are planned together.'],
  ['Is squint surgery safe?','It is among the most common eye surgeries with a strong safety record, but like all surgery it has risks, discussed before consent.'],
 ]],
'premature-baby-eye-screening' => [
 'title' => 'Premature Baby Eye Screening (ROP): A Time-Critical Guide for Parents',
 'h1' => 'Retinopathy of Prematurity — Why Timely Screening Protects Your Baby\'s Sight',
 'intro' => 'If your baby was born prematurely or with low birth weight, a specific retina screening called ROP screening exists for one reason: retinopathy of prematurity is highly treatable when caught in its window.',
 'speciality' => 'uveitis',
 'sections' => [
  ['Why premature babies need eye screening','Blood vessels in the retina finish developing in the last weeks of pregnancy. When a baby is born early, this development continues outside the womb under unusual conditions and can grow abnormally — sometimes toward detachment.'],
  ['It is nobody\'s fault','ROP is related to prematurity itself and the baby\'s overall medical course. It is not caused by anything parents did or failed to do. The empowering part: screening works.'],
  ['The screening schedule','ROP screening typically starts 2–4 weeks after birth (or by 31–33 weeks corrected age, whichever is earlier) and repeats every 1–2 weeks until the retina is fully developed. Your neonatologist and eye specialist will set the exact dates — keeping them is essential.'],
  ['Treatment when needed','When ROP reaches treatable stages, laser photocoagulation or anti-VEGF injections are highly effective. Advanced disease may need surgery, which is why the schedule must not slip.'],
 ],
 'redflags' => ['Missed screening appointment for a premature baby — reschedule immediately','Any white reflex or wandering eyes noticed later in infancy'],
 'faq' => [
  ['Is ROP screening painful for the baby?','The examination is brief with topical anaesthetic drops; babies may cry from being held still, but it is over quickly and is not harmful.'],
  ['If the first screening is normal, are we done?','Usually not — repeat screenings follow retinal development until the specialist confirms vessels have matured safely.'],
  ['Can ROP come back after treatment?','Treated babies need longer follow-up, including checks for refractive error and lazy eye as they grow.'],
 ]],
];
}
