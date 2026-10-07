-- ============================================================
-- besteyedoctordelhi.com - MySQL 8 schema (utf8mb4)
-- Import order: run this file first, then seed.sql
-- ============================================================
CREATE DATABASE IF NOT EXISTS besteye_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE besteye_db;

SET FOREIGN_KEY_CHECKS = 0;

-- ---------- Roles / Permissions ----------
CREATE TABLE roles (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL UNIQUE,
  description VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE permissions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  role_id INT UNSIGNED NOT NULL,
  perm VARCHAR(80) NOT NULL,
  UNIQUE KEY uq_role_perm (role_id, perm),
  FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------- Admins ----------
CREATE TABLE admins (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role_id INT UNSIGNED NOT NULL,
  otp_secret VARCHAR(64) NULL,
  status ENUM('active','disabled') DEFAULT 'active',
  last_login_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME NULL,
  FOREIGN KEY (role_id) REFERENCES roles(id),
  INDEX idx_admins_status (status)
) ENGINE=InnoDB;

CREATE TABLE admin_login_attempts (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(150) NOT NULL,
  ip VARCHAR(45) NOT NULL,
  success TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_ala_email (email),
  INDEX idx_ala_ip_time (ip, created_at)
) ENGINE=InnoDB;

CREATE TABLE rate_limits (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  bucket VARCHAR(50) NOT NULL,
  ip VARCHAR(45) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_rl (bucket, ip, created_at)
) ENGINE=InnoDB;

-- ---------- Doctors ----------
CREATE TABLE specialities (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(100) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  short_desc VARCHAR(500) NULL,
  sort_order INT DEFAULT 0,
  status ENUM('draft','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE doctors (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(120) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  designation VARCHAR(200) NULL,
  qualifications TEXT NULL,
  qualifications_verified TINYINT(1) DEFAULT 0,
  bio LONGTEXT NULL,
  focus_areas VARCHAR(500) NULL,
  languages VARCHAR(200) NULL,
  photo_path VARCHAR(255) NULL,
  sort_order INT DEFAULT 0,
  status ENUM('draft','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME NULL,
  INDEX idx_doctors_status (status)
) ENGINE=InnoDB;

CREATE TABLE doctor_credentials (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  doctor_id INT UNSIGNED NOT NULL,
  credential_type VARCHAR(100) NOT NULL,   -- degree / registration / fellowship / membership
  title VARCHAR(200) NOT NULL,
  issuer VARCHAR(200) NULL,
  year SMALLINT NULL,
  verified TINYINT(1) DEFAULT 0,
  verified_by INT UNSIGNED NULL,
  verified_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
  FOREIGN KEY (verified_by) REFERENCES admins(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE doctor_specialities (
  doctor_id INT UNSIGNED NOT NULL,
  speciality_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (doctor_id, speciality_id),
  FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
  FOREIGN KEY (speciality_id) REFERENCES specialities(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------- Conditions / Treatments ----------
CREATE TABLE conditions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(120) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  speciality_id INT UNSIGNED NULL,
  summary VARCHAR(600) NULL,
  red_flags TEXT NULL,
  content LONGTEXT NULL,
  reviewer_name VARCHAR(150) NULL,
  reviewed_at DATE NULL,
  next_review_at DATE NULL,
  status ENUM('draft','review','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (speciality_id) REFERENCES specialities(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE treatments (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(120) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  speciality_id INT UNSIGNED NULL,
  summary VARCHAR(600) NULL,
  content LONGTEXT NULL,
  reviewer_name VARCHAR(150) NULL,
  reviewed_at DATE NULL,
  next_review_at DATE NULL,
  status ENUM('draft','review','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (speciality_id) REFERENCES specialities(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE locations (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  address TEXT NOT NULL,
  landmark VARCHAR(255) NULL,
  phone VARCHAR(30) NULL,
  phone_verified TINYINT(1) DEFAULT 0,
  map_embed VARCHAR(1000) NULL,
  timings TEXT NULL,
  holiday_note VARCHAR(255) NULL,
  status ENUM('draft','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------- Leads / Forms ----------
CREATE TABLE appointments (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ref_id VARCHAR(30) NOT NULL UNIQUE,
  patient_name VARCHAR(150) NOT NULL,
  age_band VARCHAR(20) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(150) NULL,
  doctor_id INT UNSIGNED NULL,
  concern VARCHAR(150) NULL,
  preferred_date DATE NULL,
  time_preference VARCHAR(50) NULL,
  existing_patient TINYINT(1) DEFAULT 0,
  message TEXT NULL,
  status ENUM('new','contacted','confirmed','completed','cancelled') DEFAULT 'new',
  admin_note TEXT NULL,
  consent_given TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE SET NULL,
  INDEX idx_appt_status (status),
  INDEX idx_appt_date (preferred_date)
) ENGINE=InnoDB;

CREATE TABLE appointment_notes (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  appointment_id BIGINT UNSIGNED NOT NULL,
  admin_id INT UNSIGNED NULL,
  note TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE,
  FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE enquiries (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ref_id VARCHAR(30) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(150) NULL,
  subject VARCHAR(150) NULL,
  message TEXT NOT NULL,
  status ENUM('new','replied','closed') DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_enq_status (status)
) ENGINE=InnoDB;

CREATE TABLE second_opinion_requests (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ref_id VARCHAR(30) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(150) NULL,
  current_diagnosis VARCHAR(255) NULL,
  question TEXT NULL,
  file_path VARCHAR(255) NULL,       -- private storage, random filename
  file_orig VARCHAR(255) NULL,
  consent_given TINYINT(1) DEFAULT 0,
  status ENUM('new','in_review','answered','closed') DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_so_status (status)
) ENGINE=InnoDB;

-- ---------- Uploads / Media ----------
CREATE TABLE uploads (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  orig_name VARCHAR(255) NOT NULL,
  stored_name VARCHAR(255) NOT NULL UNIQUE,
  mime VARCHAR(100) NOT NULL,
  size INT UNSIGNED NOT NULL,
  context VARCHAR(50) NOT NULL DEFAULT 'general',
  admin_id INT UNSIGNED NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE media (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  type ENUM('image','video','illustration') DEFAULT 'image',
  file_path VARCHAR(255) NOT NULL,
  alt_text VARCHAR(255) NULL,
  focal_point VARCHAR(20) NULL,
  width INT UNSIGNED NULL,
  height INT UNSIGNED NULL,
  placement VARCHAR(100) NULL,
  consent_verified TINYINT(1) DEFAULT 0,
  status ENUM('draft','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------- Content ----------
CREATE TABLE pages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(150) NOT NULL UNIQUE,
  title VARCHAR(200) NOT NULL,
  content LONGTEXT NULL,
  status ENUM('draft','review','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE page_versions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  page_id INT UNSIGNED NOT NULL,
  title VARCHAR(200) NOT NULL,
  content LONGTEXT NULL,
  edited_by INT UNSIGNED NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (page_id) REFERENCES pages(id) ON DELETE CASCADE,
  FOREIGN KEY (edited_by) REFERENCES admins(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE faqs (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  page_ref VARCHAR(150) NULL,         -- e.g. 'cataract' or global 'faqs'
  question VARCHAR(300) NOT NULL,
  answer TEXT NOT NULL,
  sort_order INT DEFAULT 0,
  status ENUM('draft','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE article_categories (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(100) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE articles (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(150) NOT NULL UNIQUE,
  category_id INT UNSIGNED NULL,
  title VARCHAR(250) NOT NULL,
  excerpt VARCHAR(500) NULL,
  content LONGTEXT NULL,
  author_name VARCHAR(150) NULL,
  reviewer_name VARCHAR(150) NULL,
  reviewed_at DATE NULL,
  next_review_at DATE NULL,
  sources TEXT NULL,
  status ENUM('draft','review','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES article_categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE testimonials (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  patient_name VARCHAR(150) NOT NULL,
  content TEXT NOT NULL,
  treatment_ref VARCHAR(150) NULL,
  source VARCHAR(100) NULL,          -- how collected
  consent_given TINYINT(1) DEFAULT 0,
  consent_date DATE NULL,
  status ENUM('draft','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------- SEO ----------
CREATE TABLE redirects (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  from_path VARCHAR(255) NOT NULL,
  to_path VARCHAR(255) NOT NULL,
  type SMALLINT DEFAULT 301,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_redir (from_path)
) ENGINE=InnoDB;

CREATE TABLE seo_meta (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  page_path VARCHAR(255) NOT NULL UNIQUE,
  meta_title VARCHAR(200) NULL,
  meta_description VARCHAR(400) NULL,
  canonical VARCHAR(255) NULL,
  og_image VARCHAR(255) NULL,
  schema_json JSON NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE schema_overrides (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  page_path VARCHAR(255) NOT NULL,
  schema_type VARCHAR(80) NOT NULL,
  schema_json JSON NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------- System ----------
CREATE TABLE site_settings (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  skey VARCHAR(100) NOT NULL UNIQUE,
  svalue TEXT NULL,
  verified TINYINT(1) DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE audit_logs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  admin_id INT UNSIGNED NULL,
  action VARCHAR(100) NOT NULL,
  detail TEXT NULL,
  ip VARCHAR(45) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_audit_action (action),
  INDEX idx_audit_time (created_at),
  FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE consent_records (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  form_type VARCHAR(50) NOT NULL,
  record_id BIGINT UNSIGNED NOT NULL,
  consent_text VARCHAR(500) NOT NULL,
  ip VARCHAR(45) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_consent (form_type, record_id)
) ENGINE=InnoDB;

CREATE TABLE email_logs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  to_email VARCHAR(150) NOT NULL,
  subject VARCHAR(250) NOT NULL,
  body_preview VARCHAR(500) NULL,
  status ENUM('queued','sent','failed') DEFAULT 'queued',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;
