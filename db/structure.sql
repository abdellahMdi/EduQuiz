CREATE DATABASE EduQuiz;
USE EduQuiz;

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT,
  `name` VARCHAR(50)  NOT NULL,
  `email` VARCHAR(100)  NOT NULL,
  `passord` VARCHAR(255)  NOT NULL,
  `role` ENUM('teacher', 'student') NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `quizes` (
  `id` INT AUTO_INCREMENT,
  `quiz_code` VARCHAR(12) UNIQUE,
  `title` VARCHAR(50)  NOT NULL,
  `description` VARCHAR(255),
  `teacher_id` INT NOT NULL,
  PRIMARY KEY (`id`, `quiz_code`),
  FOREIGN KEY (`teacher_id`)
      REFERENCES `users`(`id`)
);

CREATE TABLE `questions` (
  `id` INT AUTO_INCREMENT,
  `question` TEXT NOT NULL,
  `quiz_id` VARCHAR(12)  NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`quiz_id`)
      REFERENCES `quizes`(`quiz_code`)
);

CREATE TABLE `reponces` (
  `id` INT AUTO_INCREMENT,
  `option` VARCHAR(255),
  `is_correct` BOOLEAN NOT NULL DEFAULT FALSE,
  `question_id` INT NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `studentanswers` (
  `id` INT AUTO_INCREMENT,
  `qestion_id` INT NOT NULL,
  `result_id` INT NOT NULL,
  `option_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`qestion_id`)
      REFERENCES `questions`(`id`),
  FOREIGN KEY (`option_id`)
      REFERENCES `reponces`(`id`)
);

CREATE TABLE `results` (
  `id` INT AUTO_INCREMENT,
  `score` DECIMAL(4,2),
  `student_id` INT NOT NULL,
  `quiz_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`student_id`)
      REFERENCES `users`(`id`),
  FOREIGN KEY (`quiz_id`)
      REFERENCES `quizes`(`id`),
  FOREIGN KEY (`id`)
      REFERENCES `studentanswers`(`result_id`)
);