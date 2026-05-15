<?php

require_once "../../config/Database.php";

class ScoreService {

    private $conn;

    public function __construct() {

        $database = new Database();
        $this->conn = $database->connect();
    }

    public function calculerScore($result_id) {

        // Réponses étudiant
        $sqlStudent = "SELECT reponce_id 
                       FROM studentanswers
                       WHERE result_id = ?";

        $stmtStudent = $this->conn->prepare($sqlStudent);
        $stmtStudent->execute([$result_id]);

        $studentAnswers = $stmtStudent->fetchAll(PDO::FETCH_COLUMN);



        // Bonnes réponses
        $sqlCorrect = "SELECT id
                       FROM reponces
                       WHERE is_correct = TRUE";

        $stmtCorrect = $this->conn->prepare($sqlCorrect);
        $stmtCorrect->execute();

        $correctAnswers = $stmtCorrect->fetchAll(PDO::FETCH_COLUMN);



        // Comparaison
        $score = 0;

        for($i = 0; $i < count($studentAnswers); $i++) {

            if($studentAnswers[$i] == $correctAnswers[$i]) {

                $score++;
            }
        }

        return $score;
    }
    public function getWrongAnswers($result_id) {

    $sql = "SELECT 
                questions.question,
                studentanswers.reponce_id AS student_answer,
                correct.id AS correct_answer

            FROM studentanswers

            JOIN questions 
            ON questions.id = studentanswers.question_id

            JOIN reponces AS correct
            ON correct.question_id = questions.id
            AND correct.is_correct = 1

            WHERE studentanswers.result_id = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([$result_id]);

    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $wrongAnswers = [];

    for($i = 0; $i < count($answers); $i++) {

        if($answers[$i]['student_answer'] != $answers[$i]['correct_answer']) {

            $wrongAnswers[] = $answers[$i];
        }
    }

    return $wrongAnswers;
}
}
?>
