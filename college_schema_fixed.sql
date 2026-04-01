-- Corrected schema for the `college` database
-- Notes:
-- 1) Uses InnoDB so foreign keys actually work.
-- 2) Adds AUTO_INCREMENT primary keys.
-- 3) Fixes missing PKs and links between tables.
-- 4) Keeps the table name `staf` to match the current PHP project.

CREATE DATABASE IF NOT EXISTS `college`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `college`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `marks`;
DROP TABLE IF EXISTS `enrollment`;
DROP TABLE IF EXISTS `exam`;
DROP TABLE IF EXISTS `subjects`;
DROP TABLE IF EXISTS `classes`;
DROP TABLE IF EXISTS `staff`;
DROP TABLE IF EXISTS `courses`;
DROP TABLE IF EXISTS `student`;
DROP TABLE IF EXISTS `designation`;
DROP TABLE IF EXISTS `departments`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `departments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dept_name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_departments_dept_name` (`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `designation` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `designation` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_designation_name` (`designation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `student` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `mobile` VARCHAR(15) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `gender` ENUM('male', 'female', 'other') NOT NULL,
  `dob` DATE NOT NULL,
  `father_name` VARCHAR(50) NOT NULL,
  `mother_name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `courses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `course_name` VARCHAR(100) NOT NULL,
  `dept_id` INT DEFAULT NULL,
  `duration` INT DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_courses_dept_id` (`dept_id`),
  CONSTRAINT `fk_courses_departments`
    FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`)
    ON UPDATE CASCADE
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `staff` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `mobile` VARCHAR(15) NOT NULL,
  `e_mail` VARCHAR(100) NOT NULL,
  `designation_id` INT DEFAULT NULL,
  `salary` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `date_of_joining` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_staff_email` (`e_mail`),
  KEY `idx_staff_designation_id` (`designation_id`),
  CONSTRAINT `fk_staff_designation`
    FOREIGN KEY (`designation_id`) REFERENCES `designation` (`id`)
    ON UPDATE CASCADE
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `classes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `class_name` VARCHAR(50) NOT NULL,
  `course_id` INT DEFAULT NULL,
  `year` YEAR DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_classes_course_id` (`course_id`),
  CONSTRAINT `fk_classes_courses`
    FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
    ON UPDATE CASCADE
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `subjects` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subject_name` VARCHAR(100) NOT NULL,
  `course_id` INT NOT NULL,
  `teacher_id` INT DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_subjects_course_id` (`course_id`),
  KEY `idx_subjects_teacher_id` (`teacher_id`),
  CONSTRAINT `fk_subjects_courses`
    FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT `fk_subjects_staff`
    FOREIGN KEY (`teacher_id`) REFERENCES `staff` (`id`)
    ON UPDATE CASCADE
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `enrollment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `student_id` INT NOT NULL,
  `class_id` INT NOT NULL,
  `admission_date` DATE DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_enrollment_student_class` (`student_id`, `class_id`),
  KEY `idx_enrollment_class_id` (`class_id`),
  CONSTRAINT `fk_enrollment_student`
    FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT `fk_enrollment_class`
    FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `exam` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `exam_name` VARCHAR(100) NOT NULL,
  `subject_id` INT NOT NULL,
  `exam_date` DATE DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_exam_subject_id` (`subject_id`),
  CONSTRAINT `fk_exam_subject`
    FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `marks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `student_id` INT NOT NULL,
  `exam_id` INT NOT NULL,
  `marks_obtained` INT NOT NULL,
  `max_marks` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_marks_student_exam` (`student_id`, `exam_id`),
  KEY `idx_marks_exam_id` (`exam_id`),
  CONSTRAINT `fk_marks_student`
    FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT `fk_marks_exam`
    FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT `chk_marks_range`
    CHECK (`marks_obtained` <= `max_marks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample master data
INSERT INTO `departments` (`dept_name`) VALUES
('Science'),
('Commerce'),
('Arts');

INSERT INTO `designation` (`designation`) VALUES
('Admin'),
('Teacher'),
('Clerk');

INSERT INTO `courses` (`course_name`, `dept_id`, `duration`) VALUES
('BSc Mathematics', 1, 3),
('BCom', 2, 3),
('BA English', 3, 3);

INSERT INTO `staff` (`name`, `mobile`, `e_mail`, `designation_id`, `salary`, `date_of_joining`) VALUES
('Ram', '9898989898', 'ram@example.com', 1, 11111.00, '2026-03-06'),
('Raj', '8686868686', 'raj@example.com', 2, 12000.00, '2020-12-12');

INSERT INTO `classes` (`class_name`, `course_id`, `year`) VALUES
('BSc Maths - First Year', 1, 2026),
('BCom - First Year', 2, 2026);

INSERT INTO `student` (`name`, `mobile`, `address`, `gender`, `dob`, `father_name`, `mother_name`) VALUES
('Lalitha', '9898989898', 'Golok', 'female', '2020-01-02', 'Krishna', 'Rukmini'),
('Suresh', '8987483647', 'Belagavi', 'male', '2025-12-01', 'Siva', 'Parvathi');

INSERT INTO `subjects` (`subject_name`, `course_id`, `teacher_id`) VALUES
('Algebra', 1, 2),
('Statistics', 1, 2),
('Financial Accounting', 2, 2);

INSERT INTO `enrollment` (`student_id`, `class_id`, `admission_date`) VALUES
(1, 1, '2026-06-01'),
(2, 2, '2026-06-02');

INSERT INTO `exam` (`exam_name`, `subject_id`, `exam_date`) VALUES
('Mid Term Algebra', 1, '2026-09-10'),
('Final Algebra', 1, '2026-12-10');

INSERT INTO `marks` (`student_id`, `exam_id`, `marks_obtained`, `max_marks`) VALUES
(1, 1, 78, 100),
(2, 1, 84, 100);
