<?php

require_once __DIR__ . "/../../config/Database.php";

class ScoreService {

    private $conn;

    public function __construct() {

        $database = new Database();
        $this->conn = $database->connect();
    }

  public function calculerScore($result_id) {

    // Student answers
    $sql = "SELECT reponce_id 
            FROM studentanswers
            WHERE result_id = ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$result_id]);

    $studentAnswers = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $score = 0;

    foreach ($studentAnswers as $answer) {

        $sqlCheck = "SELECT COUNT(*) 
                     FROM reponces 
                     WHERE id = ? AND is_correct = 1";

        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->execute([$answer]);

        if ($stmtCheck->fetchColumn() > 0) {
            $score++;
        }
    }

    return $score;
}
   public function getWrongAnswers($result_id) {

    $sql = "
        SELECT 
            q.question,
            sa.reponce_id AS student_answer,
            correct.id AS correct_answer,
            sr.option_text AS student_text,
            cr.option_text AS correct_text
        FROM studentanswers sa

        JOIN questions q 
            ON q.id = sa.question_id

        JOIN reponces sr 
            ON sr.id = sa.reponce_id

        JOIN reponces cr 
            ON cr.question_id = q.id 
            AND cr.is_correct = 1

        WHERE sa.result_id = ?
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$result_id]);

    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $wrongAnswers = [];

    foreach ($answers as $a) {
        if ($a['student_answer'] != $a['correct_answer']) {
            $wrongAnswers[] = $a;
        }
    }

    return $wrongAnswers;
}
}
?>
