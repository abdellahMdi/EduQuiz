CREATE DATABASE EduQuiz;
USE EduQuiz;

-- 1. Table Users (Jam3a les profs o les étudiants)
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(50) NOT NULL,
                       email VARCHAR(100) UNIQUE NOT NULL,
                       password VARCHAR(255) NOT NULL, -- 255 bach y9bel l'hashage dyal PHP
                       role ENUM('teacher', 'student') NOT NULL
);

-- 2. Table Quizzes
CREATE TABLE quizzes (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         quiz_code VARCHAR(12) UNIQUE NOT NULL,
                         title VARCHAR(50) NOT NULL,
                         description VARCHAR(255),
                         teacher_id INT NOT NULL,
                         FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 3. Table Questions
CREATE TABLE questions (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           quiz_id INT NOT NULL,
                           question_text TEXT NOT NULL,
                           FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

-- 4. Table Options (Les choix de réponses : y9dro ykono 2, 4, wla 6 !)
CREATE TABLE options (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         question_id INT NOT NULL,
                         option_text VARCHAR(255) NOT NULL,
                         is_correct BOOLEAN NOT NULL DEFAULT FALSE, -- BOOLEAN bach n3rfo wach had l'option hiya s7i7a
                         FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

-- 5. Table Attempts (L'étudiant mli kaywrej l quiz)
CREATE TABLE attempts (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          student_id INT NOT NULL,
                          quiz_id INT NOT NULL,
                          score DECIMAL(4,2) NULL, -- NULL f lbedya, hta ysali 3ad n3mroha
                          FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
                          FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

-- 6. Table Student_Answers (Ach khtar l'étudiant f kol question)
CREATE TABLE student_answers (
                                 id INT AUTO_INCREMENT PRIMARY KEY,
                                 attempt_id INT NOT NULL,
                                 question_id INT NOT NULL,
                                 option_id INT NOT NULL, -- L'ID dyal l'option li khtar
                                 FOREIGN KEY (attempt_id) REFERENCES attempts(id) ON DELETE CASCADE,
                                 FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
                                 FOREIGN KEY (option_id) REFERENCES options(id) ON DELETE CASCADE
);