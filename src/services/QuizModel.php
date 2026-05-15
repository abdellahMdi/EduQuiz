<?php
declare(strict_types=1);
namespace services;

use PDO;

class QuizModel
{
private PDO $pdo;
public function __construct(PDO $pdo)
{
    $this->pdo = $pdo;
}
public function createQuiz(int $teacherId , string $title , string $description ) : ?string
{
try {
    $quizCode = 'QZ-'.strtoupper(substr(uniqid(),-5));
    $sql = "INSERT INTO quizzes (quiz_code, title, description, teacher_id) VALUES (?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$quizCode, $title, $description, $teacherId]);
    return $quizCode;
} catch (PDOException $e) {
     return null;
}
}
public function addQuestionWithOptions(int $quizId , string $questionText , array $options ,array $correctIndexes) : bool
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
            // Kan9elbo wach had l'index kayn f liste dyal les checkboxes li tcochaw s7a7
            $isCorrect = in_array((string)$index, $correctIndexes, true) ? 1 : 0;

            $stmtOption->execute([$questionId, $text, $isCorrect]);
            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
             $this->pdo->rollBack();
            return false;
        }
}
}