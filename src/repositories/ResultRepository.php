<?php

require_once __DIR__ . "/../../config/Database.php";

class ResultRepository {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

   public function getResultsByQuiz($quiz_id) {

    $sql = "
        SELECT 
            r.id AS result_id,
            r.score,
            u.name AS student_name
        FROM results r
        JOIN users u ON u.id = r.student_id
        WHERE r.quiz_id = ?
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$quiz_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getDashboardResults($quiz_id) {

        $sql = "
            SELECT 
                r.id AS result_id,
                u.name AS student_name,
                r.score AS score
            FROM results r
            JOIN users u 
                ON u.id = r.student_id
            WHERE r.quiz_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$quiz_id]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = [];

        foreach ($rows as $row) {
            $score = (float) $row['score'];

            $data[] = [
                'name' => $row['student_name'],
                'score' => $score,
                'status' => $score >= 10 ? 'Validé' : 'À revoir',
            ];
        }

        return $data;
    }
}