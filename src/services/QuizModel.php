<?php
declare(strict_types=1);

namespace services;

use PDO;
use PDOException;

class QuizModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createQuiz(int $teacherId, string $title, string $description): ?array
    {
        try {
            $quizCode = 'QZ-' . strtoupper(substr(uniqid(), -5));
            $sql = "INSERT INTO quizzes (quiz_code, title, description, teacher_id) VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$quizCode, $title, $description, $teacherId]);

            return [
                'id' => (int) $this->pdo->lastInsertId(),
                'code' => $quizCode
            ];
        } catch (PDOException $e) {
            return null;
        }
    }

    public function addQuestionWithOptions(int $quizId, string $questionText, array $options, array $correctIndexes): bool
    {
        try {
            $this->pdo->beginTransaction();

            $sqlQuestion = "INSERT INTO questions (quiz_id, question) VALUES (?, ?)";
            $stmtQuestion = $this->pdo->prepare($sqlQuestion);
            $stmtQuestion->execute([$quizId, $questionText]);

            $questionId = (int) $this->pdo->lastInsertId();

            $sqlOption = "INSERT INTO reponces (question_id, option_text, is_correct) VALUES (?, ?, ?)";
            $stmtOption = $this->pdo->prepare($sqlOption);

            foreach ($options as $index => $text) {
                $isCorrect = in_array((string)$index, $correctIndexes, true) ? 1 : 0;
                $stmtOption->execute([$questionId, $text, $isCorrect]);
            }

            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function getQuestionsByQuizId(int $quizId): array
    {
        $sql = "SELECT q.id AS question_id, q.question, r.id AS reponce_id, r.option_text, r.is_correct 
                FROM questions q 
                LEFT JOIN reponces r ON q.id = r.question_id 
                WHERE q.quiz_id = ? 
                ORDER BY q.id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$quizId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $questions = [];
        foreach ($rows as $row) {
            $qId = $row['question_id'];
            if (!isset($questions[$qId])) {
                $questions[$qId] = [
                    'id' => $qId,
                    'question' => $row['question'],
                    'options' => []
                ];
            }
            if ($row['reponce_id']) {
                $questions[$qId]['options'][] = [
                    'id' => $row['reponce_id'],
                    'text' => $row['option_text'],
                    'is_correct' => $row['is_correct']
                ];
            }
        }
        return array_values($questions);
    }

    public function deleteQuestion(int $questionId): bool
    {
        try {
            $sql = "DELETE FROM questions WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$questionId]);
        } catch (PDOException $e) {
            return false;
        }
    }
}