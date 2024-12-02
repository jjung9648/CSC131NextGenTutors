-- Drop existing tables if they exist
DROP TABLE IF EXISTS `attendance`;
DROP TABLE IF EXISTS `performance`;
DROP TABLE IF EXISTS `tutor_hours`;
DROP TABLE IF EXISTS `assignments`;
DROP TABLE IF EXISTS `subjects`;
DROP TABLE IF EXISTS `students`;
DROP TABLE IF EXISTS `tutors`;
DROP TABLE IF EXISTS `users`;
-- Create users table
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Insert initial data into users table
INSERT INTO `users` (`email`, `password`)
VALUES (
    'tuan@example.com',
    '$2y$10$ThXyVunIPkBbJoidYYxBC.KmwE7dlPgdFLWKPjKQY59EraW735lgy'
  );
-- Create tutors table
CREATE TABLE `tutors` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL
);
-- Create students table
CREATE TABLE `students` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL
);
-- Create subjects table
CREATE TABLE `subjects` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL
);
-- Create assignments table
CREATE TABLE `assignments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tutor_id` INT NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `grade` INT NOT NULL,
  `date` DATE NOT NULL,
  FOREIGN KEY (`tutor_id`) REFERENCES `tutors`(`id`)
);
-- Create attendance table
CREATE TABLE `attendance` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  `date` DATE NOT NULL,
  `status` ENUM('Present', 'Absent') NOT NULL,
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`),
  FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`)
);
-- Create performance table
CREATE TABLE `performance` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  `grade` INT NOT NULL,
  `date` DATE NOT NULL,
  `tutor_id` INT NOT NULL,
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`),
  FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`),
  FOREIGN KEY (`tutor_id`) REFERENCES `tutors`(`id`)
);
-- Create tutor_hours table
CREATE TABLE `tutor_hours` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tutor_id` INT NOT NULL,
  `week_start` DATE NOT NULL,
  `hours` INT NOT NULL,
  FOREIGN KEY (`tutor_id`) REFERENCES `tutors`(`id`)
);