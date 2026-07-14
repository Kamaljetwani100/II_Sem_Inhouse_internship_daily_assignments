-- =====================================================
-- Job Application Tracker - Database Schema
-- =====================================================
-- Import this file in phpMyAdmin (XAMPP) to create the
-- database and tables required for this project.
-- =====================================================

CREATE DATABASE IF NOT EXISTS job_tracker CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE job_tracker;

-- -----------------------------------------------------
-- Table: users
-- Stores registered user accounts
-- -----------------------------------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table: jobs
-- Stores job applications added by each user
-- Linked to users table using a foreign key (user_id)
-- -----------------------------------------------------
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_name VARCHAR(150) NOT NULL,
    job_title VARCHAR(150) NOT NULL,
    location VARCHAR(150) NOT NULL,
    salary VARCHAR(50) DEFAULT NULL,
    applied_date DATE NOT NULL,
    status ENUM('Applied', 'Interview', 'Selected', 'Rejected') NOT NULL DEFAULT 'Applied',
    notes TEXT DEFAULT NULL,
    job_link VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_jobs_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Helpful index for search & filter performance
-- -----------------------------------------------------
CREATE INDEX idx_jobs_user_status ON jobs(user_id, status);
CREATE INDEX idx_jobs_company_title ON jobs(company_name, job_title);
