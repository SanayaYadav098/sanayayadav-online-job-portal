-- ========================================
-- Job Portal Advanced Features Database Schema
-- ========================================

-- ========================================
-- 1. VIRTUAL INTERVIEW SYSTEM TABLES
-- ========================================

-- Interview Schedules
CREATE TABLE IF NOT EXISTS `interview_schedules` (
  `id_interview` int(11) NOT NULL AUTO_INCREMENT,
  `id_application` int(11) NOT NULL,
  `id_jobseeker` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_jobpost` int(11) NOT NULL,
  `interview_date` datetime NOT NULL,
  `interview_type` enum('text_chat','video_call','both') DEFAULT 'text_chat',
  `video_call_link` varchar(500) DEFAULT NULL,
  `status` enum('scheduled','ongoing','completed','cancelled') DEFAULT 'scheduled',
  `notes` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_interview`),
  KEY `id_application` (`id_application`),
  KEY `id_jobseeker` (`id_jobseeker`),
  KEY `id_company` (`id_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Interview Chat Messages
CREATE TABLE IF NOT EXISTS `interview_messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_interview` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_type` enum('jobseeker','company') NOT NULL,
  `message_text` text NOT NULL,
  `attachment_url` varchar(500),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_message`),
  KEY `id_interview` (`id_interview`),
  KEY `sender_id` (`sender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Interview Feedback
CREATE TABLE IF NOT EXISTS `interview_feedback` (
  `id_feedback` int(11) NOT NULL AUTO_INCREMENT,
  `id_interview` int(11) NOT NULL,
  `rated_by` int(11) NOT NULL,
  `rater_type` enum('jobseeker','company') NOT NULL,
  `rating` int(1) NOT NULL COMMENT '1-5 stars',
  `feedback_text` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_feedback`),
  KEY `id_interview` (`id_interview`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- 2. AI JOB RECOMMENDATION TABLES
-- ========================================

-- User Skills Profile (Enhanced)
CREATE TABLE IF NOT EXISTS `user_skills_profile` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL UNIQUE,
  `years_experience` int(3),
  `job_preferences` varchar(500) COMMENT 'Comma-separated job titles',
  `industry_preferences` varchar(500) COMMENT 'Comma-separated industry IDs',
  `salary_expectation_min` decimal(10,2),
  `salary_expectation_max` decimal(10,2),
  `willing_to_relocate` boolean DEFAULT FALSE,
  `preferred_locations` varchar(500) COMMENT 'Comma-separated city IDs',
  `work_type_preferences` varchar(100) COMMENT 'Full Time, Part Time, Internship',
  `careertype_id` int(3),
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_profile`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Job Recommendations
CREATE TABLE IF NOT EXISTS `job_recommendations` (
  `id_recommendation` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_jobpost` int(11) NOT NULL,
  `match_score` decimal(5,2) COMMENT 'Score from 0-100',
  `match_reason` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `is_viewed` boolean DEFAULT FALSE,
  `view_date` timestamp NULL,
  PRIMARY KEY (`id_recommendation`),
  KEY `id_user` (`id_user`),
  KEY `id_jobpost` (`id_jobpost`),
  UNIQUE KEY `unique_recommendation` (`id_user`, `id_jobpost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- 3. TOOLS & RESOURCES TABLES
-- ========================================

-- Resume Drafts
CREATE TABLE IF NOT EXISTS `resume_drafts` (
  `id_resume` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `resume_title` varchar(255) NOT NULL,
  `fullname` varchar(255),
  `professional_headline` text,
  `summary` text,
  `contact_email` varchar(255),
  `contact_phone` varchar(20),
  `contact_location` varchar(255),
  `education_json` longtext COMMENT 'JSON array of education entries',
  `experience_json` longtext COMMENT 'JSON array of experience entries',
  `skills_json` longtext COMMENT 'JSON array of skills',
  `certifications_json` longtext COMMENT 'JSON array of certifications',
  `is_active` boolean DEFAULT FALSE,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_resume`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Interview Preparation Resources
CREATE TABLE IF NOT EXISTS `interview_resources` (
  `id_resource` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` enum('general','technical','behavioral','company_specific') DEFAULT 'general',
  `content` longtext,
  `tips_json` longtext COMMENT 'JSON array of tips',
  `video_url` varchar(500),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_resource`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Skill Assessment Tests
CREATE TABLE IF NOT EXISTS `skill_assessments` (
  `id_assessment` int(11) NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(100) NOT NULL,
  `description` text,
  `difficulty_level` enum('beginner','intermediate','advanced') DEFAULT 'beginner',
  `duration_minutes` int(3),
  `total_questions` int(3),
  `passing_score` decimal(5,2),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_assessment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Skill Assessment Questions
CREATE TABLE IF NOT EXISTS `assessment_questions` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `id_assessment` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_type` enum('multiple_choice','true_false','short_answer') DEFAULT 'multiple_choice',
  `options_json` longtext COMMENT 'JSON array of options',
  `correct_answer` varchar(500),
  `explanation` text,
  PRIMARY KEY (`id_question`),
  KEY `id_assessment` (`id_assessment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- User Assessment Results
CREATE TABLE IF NOT EXISTS `user_assessment_results` (
  `id_result` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_assessment` int(11) NOT NULL,
  `score` decimal(5,2),
  `percentage` decimal(5,2),
  `passed` boolean,
  `completed_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_result`),
  KEY `id_user` (`id_user`),
  KEY `id_assessment` (`id_assessment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- 4. UI & THEME SETTINGS
-- ========================================

-- User Theme Preferences
CREATE TABLE IF NOT EXISTS `user_theme_preferences` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL UNIQUE,
  `user_type` enum('jobseeker','company','admin') NOT NULL,
  `dark_mode` boolean DEFAULT FALSE,
  `theme_color` varchar(7) DEFAULT '#007bff',
  `font_size` enum('small','normal','large') DEFAULT 'normal',
  `language` varchar(10) DEFAULT 'en',
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_theme`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- 5. COVER LETTER GENERATOR
-- ========================================

CREATE TABLE IF NOT EXISTS `cover_letters` (
  `id_letter` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_jobpost` int(11),
  `letter_title` varchar(255),
  `recipient_name` varchar(255),
  `company_name` varchar(255),
  `job_title` varchar(255),
  `letter_content` longtext,
  `template_used` varchar(100),
  `is_draft` boolean DEFAULT TRUE,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_letter`),
  KEY `id_user` (`id_user`),
  KEY `id_jobpost` (`id_jobpost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- INSERT SAMPLE DATA
-- ========================================

-- Sample Interview Preparation Resources
INSERT INTO `interview_resources` (`title`, `category`, `content`, `tips_json`) VALUES
('How to Ace Your Technical Interview', 'technical', 'A comprehensive guide to preparing for technical interviews...', '["Practice coding problems", "Understand data structures", "Explain your solution clearly", "Ask clarifying questions"]'),
('Behavioral Interview Tips', 'behavioral', 'Master the STAR method for answering behavioral questions...', '["Use STAR method", "Be specific with examples", "Show enthusiasm", "Research the company"]'),
('First Impressions Matter', 'general', 'Everything you need to know about making a great first impression...', '["Arrive 10 minutes early", "Dress professionally", "Maintain eye contact", "Firm handshake"]');

-- Sample Skill Assessments
INSERT INTO `skill_assessments` (`skill_name`, `description`, `difficulty_level`, `duration_minutes`, `total_questions`, `passing_score`) VALUES
('JavaScript Basics', 'Test your JavaScript fundamentals', 'beginner', 30, 20, 70),
('Advanced PHP', 'Test advanced PHP concepts', 'advanced', 45, 25, 75),
('Data Structures', 'Test your knowledge of data structures', 'intermediate', 40, 15, 70);

COMMIT;
