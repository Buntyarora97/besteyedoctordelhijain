<?php
// Global navigation, mega menu and quick concern navigator data.
require_once __DIR__ . '/concerns.php';
require_once __DIR__ . '/treatments.php';
require_once __DIR__ . '/guides.php';

const SITE_NAV = [
    ['/', 'Home'],
    ['/find-an-eye-doctor', 'Find an Eye Doctor'],
    ['/eye-concerns/blurry-vision', 'Eye Concerns'],
    ['/eye-care/cataract', 'Treatments'],
    ['/doctors', 'Doctors'],
    ['/patient-guide/first-visit', 'Patient Guide'],
    ['/about', 'About'],
    ['/articles', 'Knowledge Hub'],
    ['/contact', 'Contact'],
];

// label, slug (under /eye-care/), one-liner, recommended speciality label
const MEGA_MENU = [
    ['Cataract','cataract','Clouding of the natural lens; the most common treatable cause of gradual vision loss after 50.','Cataract & Lens Surgery'],
    ['Cornea','cornea-and-anterior-segment','Corneal infections, scars, ocular surface disease and anterior segment problems.','Cornea & Anterior Segment'],
    ['Retina','retina-and-vitreous','Retina and vitreous disorders, including diabetic eye disease and retinal detachment.','Retina & Vitreous'],
    ['LASIK / Refractive','lasik-and-refractive-surgery','Spectacle-removal options assessed for candidacy, safety and stability.','LASIK & Refractive'],
    ['Glaucoma','glaucoma','A silent optic nerve condition usually managed with pressure control and lifelong follow-up.','Glaucoma'],
    ['Paediatric Eye Care','paediatric-ophthalmology','Children\'s vision development, squint and lazy eye assessment.','Paediatric Ophthalmology'],
    ['Squint','squint-care','Eye misalignment in children and adults; assessment for correction options.','Paediatric Ophthalmology'],
    ['Uveitis','uveitis','Inflammation inside the eye; needs timely specialist evaluation.','Uveitis & ROP'],
    ['ROP Screening','rop-screening','Time-critical retinal screening for premature babies.','Uveitis & ROP'],
    ['Dry Eye','dry-eye','Irritation, burning and fluctuating vision from tear-film problems.','Comprehensive Eye Care'],
    ['General Check-up','comprehensive-eye-check-up','Baseline vision, pressure and eye-health examination for all ages.','Comprehensive Eye Care'],
];

// Concern chip -> route mapping for the homepage quick navigator
const CONCERN_QUICK = [
    ['blurry-vision','Blurry Vision','/eye-concerns/blurry-vision'],
    ['cataract-symptoms','Cataract Symptoms','/eye-care/cataract'],
    ['red-or-painful-eye','Red/Painful Eye','/eye-concerns/red-or-painful-eye'],
    ['glasses-removal','Glasses Removal','/eye-care/lasik-and-refractive-surgery'],
    ['flashes-and-floaters','Flashes/Floaters','/eye-concerns/flashes-and-floaters'],
    ['diabetes-and-eye-health','Diabetes & Eyes','/eye-concerns/diabetes-and-eye-health'],
    ['child-eye-problems','Child\'s Eye Concern','/eye-concerns/child-eye-problems'],
    ['squint','Squint','/eye-concerns/squint'],
    ['premature-baby-eye-screening','Premature Baby/ROP','/eye-concerns/premature-baby-eye-screening'],
    ['routine-check-up','Routine Check-up','/eye-care/comprehensive-eye-check-up'],
    ['second-opinion','Second Opinion','/second-opinion'],
];

// Age group -> age band values used in forms
const AGE_BANDS = ['0-5','6-12','13-17','18-39','40-59','60+'];
