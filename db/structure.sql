CREATE DATABASE EduQuiz;
USE EduQuiz;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(50) NOT NULL,
                       email VARCHAR(100) UNIQUE NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       role ENUM('teacher', 'student') NOT NULL
);


CREATE TABLE quizzes (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         quiz_code VARCHAR(12) UNIQUE NOT NULL,
                         title VARCHAR(50) NOT NULL,
                         description VARCHAR(255),
                         teacher_id INT NOT NULL,
                         FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE questions (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           quiz_id INT NOT NULL,
                           question TEXT NOT NULL,
                           FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

CREATE TABLE reponces (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          question_id INT NOT NULL,
                          option VARCHAR(255) NOT NULL,
                          is_correct BOOLEAN NOT NULL DEFAULT FALSE,
                          FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

CREATE TABLE results (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         score DECIMAL(4,2) NOT NULL,
                         student_id INT NOT NULL,
                         quiz_id INT NOT NULL,
                         FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
                         FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

CREATE TABLE studentanswers (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                result_id INT NOT NULL,
                                question_id INT NOT NULL,
                                reponce_id INT NOT NULL,
                                FOREIGN KEY (result_id) REFERENCES results(id) ON DELETE CASCADE,
                                FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
                                FOREIGN KEY (reponce_id) REFERENCES reponces(id) ON DELETE CASCADE
);
