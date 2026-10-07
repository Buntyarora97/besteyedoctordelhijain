# Pre-Launch Verification Checklist

## Awaiting hospital approval (all currently draft/unpublished — do NOT invent)
- [ ] Final hospital name + official domain confirmation
- [ ] Dr. Arun Kumar Jain — full approved profile, qualifications, registration
- [ ] Dr. Rajat Jain — designation (Medical Director/Consultant), full CV verification
- [ ] Dr. Neha Mohan — FICO(UK)/FAICO/FLVPEI certificates, designation, speciality scope
- [ ] Public phone contacts match the approved numbers in `app/config/config.php`
- [ ] WhatsApp number
- [ ] Timings + holiday rules
- [ ] Exact map pin / verified map embed
- [ ] Services actually offered
- [ ] Equipment/technology models (admin-only placeholder until then)
- [ ] Accreditations, awards, memberships
- [ ] Insurance/TPA partners + logos
- [ ] Consultation fees / packages / prices
- [ ] Patient testimonials + image/media consents
- [ ] Emergency wording + escalation process
- [ ] Privacy/retention policy final + SMTP recipients

## Technical acceptance (tested before launch)
- [ ] All routes in sitemap.xml.php load (no 404s except intentional)
- [ ] Homepage = exactly 12 sections; About = exactly 8 sections
- [ ] Menus work with mouse, keyboard, touch
- [ ] Finder never outputs a diagnosis; urgent keywords show urgent message
- [ ] Appointment/enquiry/second-opinion forms: validate, save, email, show reference ID
- [ ] Admin: login lockout, CSRF, roles, CSV export, audit log, verification gate
- [ ] Uploads: non-executable, private storage returns 403
- [ ] 404/403/500 pages render with recovery paths
- [ ] Schema validates (MedicalClinic JSON-LD in layout)
- [ ] Canonicals, robots.txt, sitemap.xml.php correct
- [ ] Responsive at 320/375/768/1024/1366/1920
- [ ] prefers-reduced-motion disables orbit animation
- [ ] Lighthouse target 90+; CLS < 0.1

## Cross-domain (no cannibalisation)
- [ ] jaineyehospital... → institutional/facility topics
- [ ] drrajatjain.com → Rajat Jain personal/cornea/cataract
- [ ] drnehamohan.com → Neha Mohan retina/uvea/ROP
- [ ] lasiksurgeryindelhi.com → deep LASIK content (linked from refractive page)
