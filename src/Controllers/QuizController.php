<?php
declare(strict_types=1);

use services\QuizModel;

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../services/QuizModel.php';

class QuizController
{
    private QuizModel $quizModel;
    public function __construct(){
        $pdo = DB::connect();
        $this->quizModel = new QuizModel($pdo);
    }
public function showEditQuiz(int $quizId){


    require __DIR__ . '/../UI/prof.php';
}
    public function storeQuestion()
    {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizId = isset($_POST['quizId']) ? (int)$_POST['quizId'] : 0;
    $questionText = trim($_POST['question'] ?? '');
    $options = $_POST['options'] ?? [];
    $correctIndexes = $_POST['is_correct'] ?? [];
}if ($quizId > 0 && !empty($questionText) && count($options) >= 2 && count($correctIndexes) > 0) {
        $success = $this->quizModel->addQuestionWithOptions($quizId, $questionText, $options, $correctIndexes);
        if ($success) {
            header("Location: /chemin/vers/edit_quiz.php?id=" . $quizId . "&success=1");
            exit();
        }else {
            $error = "Erreur système : la question n'a pas pu être enregistrée.";
        }
    } else {
        $error = "Erreur : Veuillez entrer une question, au moins 2 options, et cocher la bonne réponse.";
    }
        if (isset($error)) {
            echo "<script>alert('$error');</script>";
            $this->showEditQuiz($quizId);
        }
      }

}