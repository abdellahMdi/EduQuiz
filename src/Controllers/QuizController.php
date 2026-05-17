<?php
declare(strict_types=1);

namespace Controllers;

use services\QuizModel;
use Database;

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../services/QuizModel.php';

class QuizController
{
    private QuizModel $quizModel;

    public function __construct()
    {
        $pdo = Database::connect();
        $this->quizModel = new QuizModel($pdo);
    }

    public function storeQuiz()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_type']) && $_POST['action_type'] === 'create_quiz') {

            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $teacherId = 1; // ID dyal l'formateur

            if (!empty($title)) {
                $result = $this->quizModel->createQuiz($teacherId, $title, $description);

                if ($result) {
                    header("Location: prof.php?quiz_id=" . $result['id'] . "&quiz_code=" . $result['code'] . "&success_quiz=1");
                    exit();
                }
            }
            header("Location: prof.php?error=1");
            exit();
        }
    }

    public function storeQuestion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_type']) && $_POST['action_type'] === 'add_question') {

            $quizId = isset($_POST['quizId']) ? (int)$_POST['quizId'] : 0;
            $questionText = trim($_POST['question'] ?? '');
            $options = $_POST['options'] ?? [];
            $correctIndexes = $_POST['is_correct'] ?? [];

            $quizCode = $_GET['quiz_code'] ?? '';

            if ($quizId > 0 && !empty($questionText) && count($options) >= 2 && count($correctIndexes) > 0) {
                $success = $this->quizModel->addQuestionWithOptions($quizId, $questionText, $options, $correctIndexes);

                if ($success) {
                    header("Location: prof.php?quiz_id=" . $quizId . "&quiz_code=" . $quizCode . "&success_question=1");
                    exit();
                }
            }

            header("Location: prof.php?quiz_id=" . $quizId . "&quiz_code=" . $quizCode . "&error_question=1");
            exit();
        }
    }

    public function getQuizQuestions(int $quizId): array
    {
        return $this->quizModel->getQuestionsByQuizId($quizId);
    }

    public function deleteQuestion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_type']) && $_POST['action_type'] === 'delete_question') {
            $questionId = (int)($_POST['question_id'] ?? 0);
            $quizId = $_GET['quiz_id'] ?? '';
            $quizCode = $_GET['quiz_code'] ?? '';

            if ($questionId > 0) {
                $this->quizModel->deleteQuestion($questionId);
                header("Location: prof.php?quiz_id=" . $quizId . "&quiz_code=" . $quizCode . "&deleted=1");
                exit();
            }
        }
    }
}