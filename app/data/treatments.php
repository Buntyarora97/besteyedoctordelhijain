<?php
// Treatment / speciality gateway pages - original content, balanced claims.
function treatment_pages(): array {
return [
'cataract' => [
 'title' => 'Cataract Surgery in Delhi: Options, Candidacy & Honest Expectations',
 'h1' => 'Cataract & Lens Surgery — Clear Options, No Pressure',
 'intro' => 'Cataract surgery is one of the most commonly performed and successful surgeries in medicine. Our role is to help you understand when surgery is genuinely needed, what choices exist, and what to expect — without sales pressure.',
 'speciality' => 'cataract',
 'sections' => [
  ['What a cataract actually is','The natural lens inside your eye gradually becomes cloudy with age. Vision blurs, colours dull, glare increases at night. Cataract is not a film over the eye and it is not reversible with drops.'],
  ['When surgery is appropriate','Surgery is considered when the cataract meaningfully affects your daily life — reading, driving, work — and glasses no longer help. The decision is yours, made with the surgeon after examination; we never push early or premium options without need.'],
  ['How modern surgery works','The cloudy lens is removed through a micro-incision using phacoemulsification and replaced with a clear artificial lens (IOL). It is typically a day-care procedure under anaesthetic drops.'],
  ['Lens choices, honestly explained','Monofocal lenses give clear vision at one distance; toric lenses correct astigmatism; multifocal and EDOF lenses reduce spectacle dependence for more activities, with trade-offs such as possible halos. The best lens is the one matched to your eyes, lifestyle and expectations — not the most expensive.'],
  ['Recovery reality','Most people resume routine activities within days. Full stabilisation takes weeks. Drops and follow-up visits matter. Serious complications are uncommon but real, and are explained before consent.'],
 ],
 'redflags' => ['Sudden vision drop in an eye known to have cataract — this needs same-day assessment'],
 'faq' => [
  ['Is cataract surgery painful?','It is done with anaesthetic drops or local anaesthesia; most patients feel pressure, not pain.'],
  ['How long does the surgery take?','Usually 15–30 minutes for the procedure itself, with a few hours of hospital stay for preparation and observation.'],
  ['Can cataract come back after surgery?','The artificial lens does not cloud. A thin membrane behind it can haze over time (posterior capsule opacification) and is cleared in minutes with a painless laser procedure.'],
  ['When can I return to work?','Desk work is often possible within 2–3 days; dusty or strenuous environments need a few weeks. Your surgeon gives personalised guidance.'],
  ['Do you guarantee 100% vision after surgery?','No honest clinic can. Most patients achieve major improvement; the exact outcome depends on the eye\'s overall health, which is assessed beforehand.'],
 ]],
'cornea-and-anterior-segment' => [
 'title' => 'Cornea & Anterior Segment Care: Infections, Scars & Ocular Surface Disease',
 'h1' => 'Cornea & Anterior Segment — the Window of the Eye',
 'intro' => 'The cornea is the clear dome at the front of the eye. Infections, injuries, scars and surface disease here can cloud vision quickly — and most are treatable when addressed early.',
 'speciality' => 'cornea',
 'sections' => [
  ['What this sub-speciality covers','Cornea specialists manage corneal infections and ulcers, ocular surface disease, scars and dystrophies, keratoconus, and conditions of the iris and lens front-segment.'],
  ['Corneal infection: a true urgency','A corneal ulcer can progress in days. Contact-lens wearers, people with eye injuries and those who self-medicate with steroid drops are at higher risk. Pain, redness and reduced vision together mean same-day assessment.'],
  ['Keratoconus','The cornea progressively thins and bulges into a cone shape, blurring and distorting vision — usually starting in the teens and twenties. Special contact lenses help; cross-linking can halt progression when done at the right stage.'],
  ['Treatment range','From targeted antimicrobials for infections, to surface rehabilitation, to corneal transplant in advanced scarring. Each option is weighed against its risks and the vision at stake.'],
 ],
 'redflags' => ['Painful red eye with reduced vision — possible corneal infection','Any eye chemical splash — irrigate immediately and seek emergency care'],
 'faq' => [
  ['Are contact lenses safe?','Yes when hygiene is strict: clean hands, proper solutions, no overnight wear unless prescribed, and immediate removal at any redness or pain.'],
  ['Can a corneal scar be removed?','Superficial scars may be treated with laser or surface procedures; deep scars may need transplant. Candidacy is decided after imaging.'],
  ['What is corneal cross-linking?','A day-procedure that strengthens a keratoconic cornea with riboflavin and controlled UV light to stop bulging. It does not reverse existing blur — that is what lenses or later surgery address.'],
 ]],
'lasik-and-refractive-surgery' => [
 'title' => 'LASIK & Refractive Surgery in Delhi: Candidacy, Safety & Honest Limits',
 'h1' => 'LASIK & Refractive Surgery — Removing Glasses, Responsibly',
 'intro' => 'Freedom from glasses is appealing — and genuinely possible for many stable prescriptions. Equally important: knowing who is not a candidate and why.',
 'speciality' => 'refractive',
 'sections' => [
  ['What refractive surgery does','These procedures reshape the cornea (LASIK, SMILE, PRK/surface ablation) or place a lens inside the eye (ICL) so light focuses correctly without glasses.'],
  ['Who is typically a candidate','Age 18+, a stable prescription for about a year, adequate corneal thickness and a healthy eye overall. Detailed measurements — corneal topography, tomography, thickness mapping — decide candidacy, not age or desire alone.'],
  ['Who should pause','Unstable power, thin or irregular corneas, keratoconus suspicion, uncontrolled diabetes, pregnancy or nursing, and certain autoimmune conditions may disqualify or defer. A no from proper testing is protection, not rejection.'],
  ['Comparing the options','LASIK is fast-healing and widely used; SMILE is flapless and suits certain higher myopes; surface procedures suit thinner corneas with more recovery time; ICL suits very high powers with adequate eye space. No option is universally best.'],
  ['Realistic expectations','Most patients see very well without glasses. Night halos, dry eye and the rare need for enhancement are discussed honestly. For deeper detail on costs, recovery and comparisons, our associated domain lasiksurgeryindelhi.com publishes dedicated guides.'],
 ],
 'redflags' => ['Anyone offering guaranteed perfect vision or same-day surgery without full testing — walk away'],
 'faq' => [
  ['Does LASIK hurt?','The procedure uses anaesthetic drops; most feel brief pressure. Post-procedure irritation for a few hours is common.'],
  ['How long does the effect last?','The correction is permanent; eyes can still change with age (presbyopia after 40) or, rarely, regression.'],
  ['Can LASIK fix reading vision after 40?','Presbyopia options exist (monovision, multifocal approaches) but involve trade-offs — discussed case by case.'],
  ['What is the first step?','A comprehensive candidacy evaluation with corneal imaging. The decision comes after data, not before.'],
 ]],
'retina-and-vitreous' => [
 'title' => 'Retina & Vitreous Care: Detachment, Holes & the Back of the Eye',
 'h1' => 'Retina & Vitreous — Guarding the Screen at the Back of the Eye',
 'intro' => 'The retina converts light into vision. Conditions here are often painless and silent until serious — which is why knowing the warning signs matters more than any other eye knowledge.',
 'speciality' => 'retina',
 'sections' => [
  ['What this sub-speciality manages','Retinal tears and detachment, vitreous haemorrhage, macular problems, diabetic retinopathy, retinal vascular blockages, and inherited retinal conditions.'],
  ['The urgency logic','A retinal tear can be sealed with a quick laser before it detaches. Once the retina detaches, surgery is needed — still highly successful in most cases, but simpler is always better.'],
  ['Common procedures explained','Laser photocoagulation seals tears or treats proliferative disease. Vitrectomy removes blood-scarred vitreous and repairs detachments. Injections (anti-VEGF/steroid) treat swelling and bleeding from retinal vessels. Each has specific indications and limits.'],
  ['Recovery honesty','Retinal surgery recovery can involve positioning, restricted activity and gradual vision return over weeks to months. Outcomes are generally best when treatment is not delayed.'],
 ],
 'redflags' => ['New shower of floaters, flashes, or a curtain over vision — same-day assessment','Sudden painless vision drop, especially in diabetics'],
 'faq' => [
  ['Can a retinal detachment heal on its own?','No. It is an emergency where every day affects the outcome.'],
  ['Is retinal laser painful?','It is done with anaesthetic drops; you see bright flashes but feel minimal discomfort.'],
  ['Will my vision fully return after detachment surgery?','It depends on how long the retina was detached and whether the macula was involved — another reason to act on symptoms immediately.'],
 ]],
'diabetic-retinopathy' => [
 'title' => 'Diabetic Retinopathy: Stages, Injections, Laser & Surgery Explained',
 'h1' => 'Diabetic Retinopathy — Treating the Stages, Protecting the Centre',
 'intro' => 'Diabetic retinopathy is managed by stage: early disease is watched with great control, advanced disease is treated precisely. Understanding the stages removes much of the fear.',
 'speciality' => 'retina',
 'sections' => [
  ['Stage one: background retinopathy','Small vessel changes without symptoms. Action: tighter sugar, BP and lipid control; annual dilated review.'],
  ['Stage two: macular involvement','Leakage near the centre (macular oedema) blurs central vision. Anti-VEGF injections, laser or steroids control the swelling; repeated treatments are common and normal.'],
  ['Stage three: proliferative retinopathy','Starved of blood flow, the retina grows fragile new vessels that bleed. Pan-retinal laser and/or injections stop the drive; vitrectomy clears non-clearing blood.'],
  ['The control connection','Eye treatment works alongside — not instead of — systemic control. The two fronts of the same battle.'],
 ],
 'redflags' => ['Any sudden blur or floaters in a person with diabetes'],
 'faq' => [
  ['Do eye injections hurt?','Numbing drops and antiseptic make the brief injection tolerable; most patients describe mild pressure.'],
  ['How many injections will I need?','It varies by response; many need a loading course then maintenance. Your retina specialist tracks this with scans.'],
  ['Can retinopathy be reversed?','Early changes can regress with control; established damage is managed to protect remaining vision — hence the emphasis on screening before symptoms.'],
 ]],
'uveitis' => [
 'title' => 'Uveitis: Eye Inflammation Causes & Long-Term Management',
 'h1' => 'Uveitis — Inflammation Inside the Eye',
 'intro' => 'Uveitis is inflammation of the uvea — the eye\'s middle layer. It can appear once or keep returning, alone or as part of a body-wide condition, and it always deserves specialist care.',
 'speciality' => 'uveitis',
 'sections' => [
  ['How it presents','Red, painful eye with light sensitivity and blurred vision is the classic acute pattern. Some forms are quiet and painless, found only on examination.'],
  ['Finding the cause','Uveitis can be linked to infections, autoimmune conditions like ankylosing spondylitis, sarcoidosis, or have no identifiable cause. Targeted blood tests and imaging help decide whether the eye is the whole story.'],
  ['Treatment approach','Steroid drops, oral medicines, or injections control inflammation; some cases need immune-modulating drugs long-term. Suppressing inflammation matters because repeated flares scar eye structures permanently.'],
  ['The follow-up discipline','Uveitis often relapses. Scheduled reviews — even when the eye feels fine — catch flares before they scar.'],
 ],
 'redflags' => ['Painful red eye with light sensitivity in someone with known autoimmune disease','Recurrent uveitis — needs a systemic work-up, not just repeat drops'],
 'faq' => [
  ['Is uveitis contagious?','No. It is an inflammatory condition, not an infection you can pass on.'],
  ['Can uveitis cause permanent damage?','Untreated or frequently relapsing uveitis can. Consistent specialist control is the protection.'],
  ['Will I need steroids forever?','Many patients taper off; some chronic types need long-term control drugs. The plan is individualised.'],
 ]],
'rop-screening' => [
 'title' => 'ROP Screening in Delhi: Schedule, Process & Treatment Window',
 'h1' => 'ROP Screening — a Timetable That Protects Premature Sight',
 'intro' => 'Retinopathy of prematurity screening follows a strict timetable because the treatment window is real but finite. This page is that timetable, explained plainly.',
 'speciality' => 'uveitis',
 'sections' => [
  ['Who needs screening','Babies born before about 34 weeks, or with birth weight below roughly 2 kg, and any baby the neonatologist flags — the hospital team will tell you if your baby is on the list.'],
  ['The first examination','Typically 2–4 weeks after birth or by 31–33 weeks of corrected age, whichever comes first.'],
  ['Repeat examinations','Every 1–2 weeks until the retina\'s vessels are safely matured. Missed visits are the main preventable risk — treat each appointment as immovable.'],
  ['If treatment is needed','Laser or injections at the treatable stages are highly effective. The screening system exists precisely so treatment happens on time.'],
 ],
 'redflags' => ['Any missed ROP appointment — call and rebook the same day'],
 'faq' => [
  ['Where is ROP screening done?','At the hospital or eye centre your neonatal team coordinates with — ask your treating team about scheduling at Jain Eye Hospital & Laser Centre, Shalimar Bagh.'],
  ['Does screening harm the baby?','No. It is brief, safe, and done with anaesthetic eye drops.'],
 ]],
'glaucoma' => [
 'title' => 'Glaucoma: The Silent Pressure Problem & Lifelong Management',
 'h1' => 'Glaucoma — Managing the Silent Thief of Sight',
 'intro' => 'Glaucoma damages the optic nerve, usually silently, usually painlessly, and the lost vision does not return. The good news: discovered early, it is highly manageable.',
 'speciality' => 'glaucoma',
 'sections' => [
  ['What actually gets damaged','It is not the number alone but the optic nerve that matters. Pressure is the main risk lever, and lowering it — by whatever means — is how progression is slowed.'],
  ['Who is at higher risk','Family history, age over 40, diabetes, high myopia, steroid use (including long-term eye drops), and previous eye injury. Higher-risk eyes deserve baseline checks even without symptoms.'],
  ['How it is detected','Eye pressure, optic nerve examination, corneal thickness and visual field testing, plus OCT nerve-fibre analysis. One test alone never settles the diagnosis.'],
  ['Treatment for life','Drops, laser (like SLT) or surgery each lower pressure by different amounts. The real discipline is follow-up: glaucoma is controlled, not cured, and control is verified over time.'],
 ],
 'redflags' => ['Sudden severe eye pain with nausea, halos and a red eye — possible acute angle closure; emergency.'],
 'faq' => [
  ['Can glaucoma be cured?','No, but with early detection and consistent treatment, most patients keep functional vision for life.'],
  ['Do glaucoma drops have side effects?','Some do; alternatives exist. Never stop drops without discussing substitution with your specialist.'],
  ['Is glaucoma hereditary?','It runs in families often enough that first-degree relatives of glaucoma patients should get screened.'],
 ]],
'paediatric-ophthalmology' => [
 'title' => 'Paediatric Ophthalmology: Children\'s Vision, Squint & Lazy Eye Care',
 'h1' => 'Paediatric Ophthalmology — Giving Young Eyes Their Best Start',
 'intro' => 'Children\'s eyes are developing, not just being used. Problems treated during the development window often resolve beautifully; the same problems treated late leave permanent deficit.',
 'speciality' => 'paediatric',
 'sections' => [
  ['Why timing beats everything','Visual pathways mature in early childhood. Lazy eye treated at 4 can reach full potential; the same eye at 14 has limited recoverability.'],
  ['What we screen and treat','Refractive error, squint, amblyopia, blocked tear ducts, congenital cataract and drooping lids (ptosis), among others.'],
  ['The examination experience','Child-friendly charts, playful cooperation and cycloplegic drops when accurate measurement needs them. Parents are guided through every step.'],
 ],
 'redflags' => ['White pupil reflex in photos','New squint after illness or injury','A child who always closes one eye in sunlight'],
 'faq' => [
  ['My 3-year-old cannot read letters — can vision still be tested?','Yes. Picture- and symbol-based charts measure young children\'s vision accurately.'],
  ['Is patching cruel?','It is short, supervised, and restores sight the child would otherwise permanently lose. Frames and reward charts make it manageable.'],
 ]],
'squint-care' => [
 'title' => 'Squint Care for Children & Adults: Alignment, Surgery & Double Vision',
 'h1' => 'Squint Care — Aligning Eyes, Protecting Vision',
 'intro' => 'Whether your child has a wandering eye or you have developed double vision as an adult, squint care follows a clear logic: find the cause, treat the vision first, then align the eyes.',
 'speciality' => 'paediatric',
 'sections' => [
  ['Children: vision before alignment','Glasses correct focusing-driven squints; patching builds the weaker eye\'s vision; surgery aligns the eyes once the visual system is prepared. Skipping to surgery without treating lazy eye wastes the operation.'],
  ['Adults: cause before correction','New adult squint signals a search for cause — nerve palsy, thyroid eye disease, decompensated childhood squint. Prisms, botulinum toxin and surgery each have their place after the diagnosis.'],
  ['Cosmetic versus functional','In children squint care is fundamentally about visual development, not appearance. In adults, relieving double vision is usually the priority.'],
 ],
 'redflags' => ['New double vision with headache or neurological symptoms — seek urgent evaluation'],
 'faq' => [
  ['At what age can squint surgery be done?','When the eyes and vision are ready — sometimes in the first years of life. The surgeon decides timing after examination.'],
  ['Does squint recur after surgery?','Alignment can drift in some patients; glasses and follow-up manage this, and re-operation is occasionally needed.'],
 ]],
'dry-eye' => [
 'title' => 'Dry Eye Treatment: From Lubricants to Advanced Surface Care',
 'h1' => 'Dry Eye — More Than Just Drops',
 'intro' => 'Chronic dry eye is a surface disease with sub-types, and matching the treatment to the sub-type is what finally brings relief.',
 'speciality' => 'comprehensive',
 'sections' => [
  ['Finding your sub-type','Evaporative dry eye (oil-layer failure from meibomian gland dysfunction) is the most common; aqueous-deficient dry eye is less common. Tests distinguish them in minutes.'],
  ['The treatment ladder','Lubricants and lid hygiene first; warm compresses and gland expression for evaporative disease; anti-inflammatory drops for surface inflammation; punctal plugs or other procedures for selected cases.'],
  ['Lifestyle levers','Blink fully and often at screens, take distance breaks, manage AC/airflow, stay hydrated, and discuss medicines that worsen dryness with your doctor.'],
 ],
 'redflags' => ['Severe pain or light sensitivity is not typical dry eye — get examined for other causes'],
 'faq' => [
  ['Which lubricant should I buy?','Preservative-free formulations are preferred for frequent use; the right viscosity depends on your pattern — ask at your examination.'],
  ['Can dry eye be cured?','Usually managed rather than cured; good control gives comfortable, clear vision for most patients.'],
 ]],
'comprehensive-eye-check-up' => [
 'title' => 'Comprehensive Eye Check-Up in Delhi: What a Full Examination Includes',
 'h1' => 'The Comprehensive Eye Check-Up — Your Vision\'s Baseline',
 'intro' => 'A proper eye check-up is more than a glasses test. It is a structured examination of every part of the eye — and the quiet problems it catches early are exactly the ones worth catching.',
 'speciality' => 'comprehensive',
 'sections' => [
  ['What the examination includes','Vision and refraction, eye pressure, slit-lamp examination of the front structures, and a dilated view of the retina when indicated. Imaging such as OCT or field testing is added based on findings.'],
  ['Who should check in, and when','Adults: at least every two years, yearly after 40 or with diabetes, hypertension or family eye history. Children: once by school age, sooner with any sign.'],
  ['What a baseline gives you','Change is the earliest signal of most eye diseases. A recorded baseline turns seems-fine into measurable certainty.'],
 ],
 'redflags' => ['Do not wait for the routine check if you have sudden symptoms — book urgent assessment instead'],
 'faq' => [
  ['How long does a full check-up take?','Allow 45–90 minutes, more if dilating drops are used (add a few hours of near-vision blur).'],
  ['Can I drive after a dilated examination?','Not advisable — bring a companion or use transport.'],
  ['Do I need a check-up if my vision is perfect?','Yes. Glaucoma, early retinopathy and early cataract do not blur vision until later.'],
 ]],
];
}
