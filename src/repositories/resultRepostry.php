<?php

require_once __DIR__ . "/../../config/Database.php";

class ResultRepository {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }




    // 🔹 Calculate score for one student
    public function calculerScore($result_id) {

        $sql = "
            SELECT COUNT(*) 
            FROM studentanswers sa
            JOIN reponces r 
                ON r.id = sa.reponce_id
            WHERE sa.result_id = ?
            AND r.is_correct = 1
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$result_id]);

        return (int) $stmt->fetchColumn();
    }

    // 🔹 Optional: wrong answers (if you need later)
    public function getWrongAnswers($result_id) {

        $sql = "
            SELECT 
                q.question,
                sr.option_text AS student_answer,
                cr.option_text AS correct_answer
            FROM studentanswers sa

            JOIN questions q ON q.id = sa.question_id
            JOIN reponces sr ON sr.id = sa.reponce_id

            JOIN reponces cr 
                ON cr.question_id = q.id 
                AND cr.is_correct = 1

            WHERE sa.result_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$result_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function getDashboardResults($quiz_id) {

    $sql = "
        SELECT 
            r.id AS result_id,
            u.name AS student_name
        FROM results r
        JOIN users u ON u.id = r.student_id
        WHERE r.quiz_id = ?
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$quiz_id]);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];

    foreach ($rows as $row) {

        $score = $this->calculerScore($row['result_id']);

        $data[] = [
            'name' => $row['student_name'],
            'score' => $score
        ];
    }

    return $data;
}
}