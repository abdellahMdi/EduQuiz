USE EduQuiz;

-- 1. Ajout des Utilisateurs (Le mot de passe pour tous est : password)
INSERT INTO users (name, email, password, role) VALUES
                                                    ('Youssef', 'youssef@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'teacher'),
                                                    ('Salwa', 'Salwa@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
                                                    ('Kawtar', 'Kawtar@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
                                                    ('Abdellah', 'Abdellah@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student');

-- 2. Ajout d'un Quiz créé par le Formateur (Youssef, id = 1)
INSERT INTO quizzes (quiz_code, title, description, teacher_id) VALUES
    ('JS-2026-X8', 'Évaluation JavaScript', 'Test des bases de php pour le groupe ', 1);

-- 3. Ajout de 2 Questions pour ce Quiz (quiz_id = 1)
INSERT INTO questions (quiz_id, question) VALUES
                                              (1, 'Comment déclarer une constante en JavaScript ?'),
                                              (1, 'Quel est le résultat de "2" + 2 en JS ?');

-- 4. Ajout des Choix (Options)
-- Options pour la Question 1 (question_id = 1)
INSERT INTO reponces (question_id, option_text, is_correct) VALUES
                                                                (1, 'let x = 5;', 0),
                                                                (1, 'const x = 5;', 1),  -- Hadi hiya li s7i7a (is_correct = 1)
                                                                (1, 'var x = 5;', 0);

-- Options pour la Question 2 (question_id = 2)
INSERT INTO reponces (question_id, option_text, is_correct) VALUES
                                                                (2, '4', 0),
                                                                (2, '22', 1),         -- Hadi hiya li s7i7a (Concaténation JS)
                                                                (2, 'NaN', 0);

-- 5. Ajout d'un Résultat (Salwa a passé le quiz et a eu 10/20)
-- Salwa a l'id = 2, le quiz a l'id = 1
INSERT INTO results (score, student_id, quiz_id) VALUES
    (10.00, 2, 1);

-- 6. Historique des réponses (studentanswers) pour voir la correction
-- Salwa a répondu juste à la Q1 (reponce_id = 2) et faux à la Q2 (reponce_id = 4 au lieu de 5)
INSERT INTO studentanswers (result_id, question_id, reponce_id) VALUES
                                                                    (1, 1, 2),
                                                                    (1, 2, 4);