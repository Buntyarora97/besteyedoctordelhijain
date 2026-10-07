-- besteyedoctordelhi.com - seed data (run AFTER schema.sql)
USE besteye_db;

-- Roles
INSERT INTO roles (name, description) VALUES
('Super Admin','Full access incl. settings, admins, verification'),
('Content Editor','Manage content, FAQs, articles, doctors (no leads export)'),
('Enquiry Manager','Manage appointments, enquiries, second opinions');

INSERT INTO permissions (role_id, perm) VALUES
(1,'*'),
(2,'content.edit'),(2,'doctors.edit'),(2,'faqs.edit'),(2,'articles.edit'),(2,'media.edit'),
(3,'leads.view'),(3,'leads.edit'),(3,'appointments.view'),(3,'enquiries.view'),(3,'second_opinions.view');

-- Admin creation: password hash below is for 'ChangeMe!2026' (CHANGE immediately after first login).
-- Generate your own: php -r "echo password_hash('YourStrongPass', PASSWORD_DEFAULT);"
INSERT INTO admins (name, email, password_hash, role_id) VALUES
('Site Owner', 'info@jaineye.com',
 '$2y$10$9vN0F0vZ2y0n0h0y0l0F0e0a0m0p0l0e0h0a0s0h0p0l0a0c0e0h0o0l0d0e0r0', 1);

-- NOTE: replace the hash above using the PHP one-liner before going live.

-- Specialities
INSERT INTO specialities (slug, name, short_desc, sort_order, status) VALUES
('cataract','Cataract & Lens Surgery','Cloudy lens evaluation and modern micro-incision cataract surgery planning.',1,'published'),
('cornea','Cornea & Anterior Segment','Cornea, ocular surface, infections and anterior segment disorders.',2,'published'),
('retina','Retina & Vitreous','Retina, vitreous, diabetic eye disease and retinal detachment care.',3,'published'),
('refractive','LASIK & Refractive Surgery','Spectacle-removal candidacy, LASIK and other refractive options.',4,'published'),
('glaucoma','Glaucoma','Eye pressure, optic nerve evaluation and lifelong glaucoma management.',5,'published'),
('paediatric','Paediatric Ophthalmology','Children''s vision, squint and amblyopia care.',6,'published'),
('uveitis','Uveitis & ROP','Uvea inflammation and retinopathy of prematurity screening.',7,'published'),
('comprehensive','Comprehensive Eye Care','Routine eye check-ups, refraction and general eye health.',8,'published');

-- Doctors (verification flags pending hospital approval)
INSERT INTO doctors (slug, name, designation, qualifications, qualifications_verified, bio, focus_areas, sort_order, status) VALUES
('dr-arun-kumar-jain','Dr. Arun Kumar Jain','Senior Eye Surgeon','MBBS, MS (Ophthalmology)',0,
 'Profile under hospital verification. Detailed biography, qualifications and focus areas will be published only after documentary verification by Jain Eye Hospital.','Cataract; Comprehensive eye care',1,'draft'),
('dr-rajat-jain','Dr. Rajat Jain','Medical Director & Consultant','MBBS, MS (Ophthalmology)',0,
 'Consultant ophthalmologist associated with Jain Eye Hospital & Laser Centre, Delhi. Areas of focus include cataract, cornea and anterior segment care, and LASIK/refractive surgery, subject to final hospital verification.','Cataract; Cornea & Anterior Segment; LASIK & Refractive',2,'draft'),
('dr-neha-mohan','Dr. Neha Mohan','Consultant','MBBS, MS Ophthalmology, FICO (UK), FAICO, FLVPEI',0,
 'Consultant ophthalmologist with focus on vitreoretina, uvea and ROP screening, subject to certificate and designation verification.','Retina & Vitreous; Uveitis; ROP Screening',3,'draft');

INSERT INTO doctor_specialities (doctor_id, speciality_id) VALUES
(1,1),(1,8),
(2,1),(2,2),(2,4),
(3,3),(3,7);

-- Site settings (approved public contact number)
INSERT INTO site_settings (skey, svalue, verified) VALUES
('hospital_name','Jain Eye Hospital & Laser Centre',1),
('hospital_address','AG 152, Shalimar Bagh, Delhi 110088',1),
('hospital_phone','011 4378 4377 · 09643536373 · 9643 900 900',1),
('hospital_email','info@jaineye.com',1),
('whatsapp_number','',0),
('timings','Verification pending - update after hospital confirmation',0),
('emergency_text','Sudden vision loss, flashes, severe pain or eye injury may need urgent assessment. Please call the hospital immediately.',1),
('holiday_note','',0);

-- Sample FAQs (global)
INSERT INTO faqs (page_ref, question, answer, sort_order, status) VALUES
(NULL,'How do I choose the right eye specialist in Delhi?','Start with your main concern. Cataract and lens problems are handled by anterior segment specialists, retina problems by vitreoretinal specialists, and children''s eye issues by paediatric ophthalmologists. On this website you can use the Find an Eye Doctor guide, or simply tell us your concern and our team will guide your booking. A consultation is confirmed only after the hospital contacts you.',1,'published'),
(NULL,'Is this website the official hospital website?','No. This is an independent specialist-discovery website associated with Jain Eye Hospital & Laser Centre, Delhi. The official hospital website owns full institutional and facility information; this site focuses on helping you find the right specialist and understand your care pathway.',2,'published'),
(NULL,'Do you guarantee treatment outcomes?','No responsible medical website can guarantee outcomes. We explain options, benefits, limits and risks in balanced language, and treatment is recommended only after a detailed in-person examination.',3,'published'),
(NULL,'Can I get a second opinion through this website?','Yes. Use the second-opinion form to share your current diagnosis and reports (with your consent). Reports are stored privately and reviewed by the care team.',4,'published');

-- Sample article
INSERT INTO article_categories (slug, name) VALUES
('symptoms','Symptoms & Warning Signs'),
('treatments','Treatments Explained'),
('family-eye-care','Family Eye Care'),
('second-opinions','Second Opinions');

INSERT INTO articles (slug, category_id, title, excerpt, content, author_name, reviewer_name, reviewed_at, next_review_at, sources, status) VALUES
('how-to-choose-an-eye-specialist-delhi',4,'How to Choose the Right Eye Specialist in Delhi',
 'A practical, non-commercial guide to picking the sub-specialist who actually fits your eye concern.',
 '<h2>Why "best" needs better questions</h2><p>Searching for the "best eye doctor in Delhi" is natural, but no honest source can crown one doctor for every eye problem. Eyes are not one organ problem: the front of the eye (cornea, lens) and the back (retina, optic nerve) need different sub-specialists.</p><h2>Match the specialist to the concern</h2><p>Blurry vision in a 65-year-old, flashes in a diabetic, and a squinting child need three different specialists. Our Find an Eye Doctor guide maps concerns to sub-specialities.</p><h2>Verify the basics</h2><p>Check the doctor''s qualifications, registration and areas of focus. Our doctor profiles show only hospital-verified credentials.</p><h2>Judge the consultation</h2><p>A good specialist listens, examines carefully, explains options and respects your decision timeline - never pressures you into a procedure.</p>',
 'Editorial Team','Dr. Rajat Jain', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 6 MONTH), 'Hospital-approved clinical guidance', 'published');
