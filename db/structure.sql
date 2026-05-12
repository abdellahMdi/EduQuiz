CREATE DATABASE EduQuiz ;

USE EduQuiz ;


CREATE TABLE `students` (
  `id` INT AUTO_INCREMENT,
  `name` VARCHAR(50),
  `email` VARCHAR(100),
  `passord` VARCHAR(20),
  PRIMARY KEY (`id`)
);

CREATE TABLE `teachers` (
  `id` INT AUTO_INCREMENT,
  `name` VARCHAR(50),
  `email` VARCHAR(100),
  `passord` VARCHAR(20),
  PRIMARY KEY (`id`)
);

CREATE TABLE `quizes` (
  `id` INT AUTO_INCREMENT,
  `quiz_code` VARCHAR(12) UNIQUE,
  `title` VARCHAR(50),
  `description` VARCHAR(255),
  `teacher_id` INT NOT NULL,
  PRIMARY KEY (`id`, `quiz_code`),
  FOREIGN KEY (`teacher_id`)
      REFERENCES `teachers`(`id`)
);

CREATE TABLE `questions` (
  `id` INT AUTO_INCREMENT,
  `question` TEXT,
  `answer_a` VARCHAR(255),
  `answer_b` VARCHAR(255),
  `answer_c` VARCHAR(255),
  `answer_d` VARCHAR(255),
  `quiz_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`quiz_id`)
      REFERENCES `quizes`(`quiz_code`)
);

CREATE TABLE `studentanswers` (
  `id` INT AUTO_INCREMENT,
  `first` VARCHAR(6),
  `second` VARCHAR(6),
  `third` VARCHAR(6),
  `fourth` VARCHAR(6),
  `qestion_id` INT NULL,
  `result_id` INT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`qestion_id`)
      REFERENCES `questions`(`id`)
);

CREATE TABLE `results` (
  `id` INT AUTO_INCREMENT,
  `score` DECIMAL(4,2),
  `student_id` INT NOT NULL,
  `quiz_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`student_id`)
      REFERENCES `students`(`id`),
  FOREIGN KEY (`quiz_id`)
      REFERENCES `quizes`(`id`),
  FOREIGN KEY (`id`)
      REFERENCES `studentanswers`(`result_id`)
);

CREATE TABLE `reponces` (
  `id` INT AUTO_INCREMENT,
  `question_id` INT NOT NULL,
  `a` VARCHAR(5),
  `b` VARCHAR(5),
  `c` VARCHAR(5),
  `d` VARCHAR(5),
  PRIMARY KEY (`id`)
);
