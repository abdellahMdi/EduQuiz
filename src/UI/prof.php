<?php
require_once __DIR__ . '/../Controllers/QuizController.php';

$quizController = new \Controllers\QuizController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action_type']) && $_POST['action_type'] === 'create_quiz') {
        $quizController->storeQuiz();
    } elseif (isset($_POST['action_type']) && $_POST['action_type'] === 'add_question') {
        $quizController->storeQuestion();
    } elseif (isset($_POST['action_type']) && $_POST['action_type'] === 'delete_question') {
        $quizController->deleteQuestion();
    }
}

$currentQuizId = $_GET['quiz_id'] ?? null;
$currentQuizCode = $_GET['quiz_code'] ?? 'Non généré';

$questionsList = [];
if ($currentQuizId) {
    $questionsList = $quizController->getQuizQuestions((int)$currentQuizId);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Quiz - Espace Formateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

<nav class="bg-white shadow-sm px-6 py-4 mb-8">
    <div class="max-w-5xl mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600"><i class="fas fa-graduation-cap mr-2"></i>EduQuiz Admin</h1>
        <span class="text-sm text-gray-500">Espace Formateur</span>
    </div>
</nav>

<div class="max-w-5xl mx-auto px-4 pb-12 grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="md:col-span-1 space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">1. Créer le Quiz</h2>

            <?php if (isset($_GET['success_quiz'])): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 text-sm" role="alert">Quiz créé avec succès !</div>
            <?php endif; ?>

            <form action="prof.php" method="POST" class="space-y-4">
                <input type="hidden" name="action_type" value="create_quiz">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Titre du Quiz</label>
                    <input type="text" name="title" required placeholder="Ex: Évaluation JavaScript" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" <?= $currentQuizId ? 'disabled' : '' ?>>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3" placeholder="Description de l'évaluation..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" <?= $currentQuizId ? 'disabled' : '' ?>></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Code d'accès (Généré)</label>
                    <div class="flex bg-gray-100 rounded-lg p-1 border border-gray-200">
                        <input type="text" value="<?= htmlspecialchars($currentQuizCode) ?>" readonly class="bg-transparent w-full px-2 text-gray-600 font-mono text-center outline-none">
                    </div>
                </div>
                <?php if ($currentQuizId): ?>
                    <button type="button" onclick="window.location.href='prof.php'" class="w-full bg-gray-800 text-white font-medium py-2 rounded-lg hover:bg-gray-900 transition">
                        + Créer un nouveau Quiz
                    </button>
                <?php else: ?>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition duration-200">
                        Enregistrer le Quiz
                    </button>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="md:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 <?= $currentQuizId ? 'border-l-blue-500' : 'border-l-gray-300 opacity-60' ?>">
            <h2 class="text-lg font-semibold mb-4">2. Ajouter une Question</h2>

            <?php if (isset($_GET['success_question'])): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 text-sm" role="alert">Question ajoutée au Quiz !</div>
            <?php endif; ?>
            <?php if (isset($_GET['error_question'])): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 text-sm" role="alert">Erreur : Veuillez bien remplir les options et cocher la bonne réponse.</div>
            <?php endif; ?>

            <?php if (!$currentQuizId): ?>
                <p class="text-red-500 text-sm mb-4"><i class="fas fa-exclamation-triangle"></i> Veuillez d'abord créer un Quiz (étape 1) avant d'ajouter des questions.</p>
            <?php endif; ?>

            <form action="prof.php?quiz_id=<?= htmlspecialchars((string)$currentQuizId) ?>&quiz_code=<?= htmlspecialchars($currentQuizCode) ?>" method="POST" class="space-y-4">
                <input type="hidden" name="action_type" value="add_question">
                <input type="hidden" name="quizId" value="<?= htmlspecialchars((string)$currentQuizId) ?>">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Votre question</label>
                    <textarea name="question" rows="2" required placeholder="Saisissez la question ici..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" <?= !$currentQuizId ? 'disabled' : '' ?>></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Options de réponse (Cochez les bonnes réponses)</label>
                    <div id="options-container" class="space-y-3">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="is_correct[]" value="0" class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded cursor-pointer" <?= !$currentQuizId ? 'disabled' : '' ?>>
                            <input type="text" name="options[]" placeholder="Option 1" required class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" <?= !$currentQuizId ? 'disabled' : '' ?>>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="is_correct[]" value="1" class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded cursor-pointer" <?= !$currentQuizId ? 'disabled' : '' ?>>
                            <input type="text" name="options[]" placeholder="Option 2" required class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" <?= !$currentQuizId ? 'disabled' : '' ?>>
                        </div>
                    </div>
                    <button type="button" onclick="ajouterOption()" class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1" <?= !$currentQuizId ? 'disabled' : '' ?>>
                        <i class="fas fa-plus-circle"></i> Ajouter une option
                    </button>
                </div>

                <div class="flex justify-end mt-4 pt-4 border-t">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-lg font-medium transition duration-200" <?= !$currentQuizId ? 'disabled' : '' ?>>
                        Ajouter la question
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold mb-4">3. Questions du Quiz (Aperçu)</h2>

            <?php if (isset($_GET['deleted'])): ?>
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-3 mb-4 text-sm">Question supprimée.</div>
            <?php endif; ?>

            <?php if (empty($questionsList)): ?>
                <p class="text-gray-500 text-sm text-center py-4">Aucune question ajoutée pour le moment.</p>
            <?php else: ?>
                <?php foreach ($questionsList as $index => $q): ?>
                    <div class="border border-gray-200 rounded-lg p-4 mb-3 relative group hover:border-blue-300 transition">

                        <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                            <form action="prof.php?quiz_id=<?= htmlspecialchars((string)$currentQuizId) ?>&quiz_code=<?= htmlspecialchars($currentQuizCode) ?>" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette question ?');">
                                <input type="hidden" name="action_type" value="delete_question">
                                <input type="hidden" name="question_id" value="<?= $q['id'] ?>">
                                <button type="submit" class="text-gray-400 hover:text-red-500" title="Supprimer"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>

                        <h3 class="font-medium text-gray-800 mb-3 pr-10">
                            <span class="text-blue-600 font-bold mr-2">Q<?= $index + 1 ?>.</span>
                            <?= htmlspecialchars($q['question']) ?>
                        </h3>

                        <ul class="space-y-2 text-sm">
                            <?php foreach ($q['options'] as $opt): ?>
                                <li class="flex items-center gap-2 <?= $opt['is_correct'] ? 'text-green-700 bg-green-50 border-green-200' : 'text-gray-600 bg-gray-50 border-gray-100' ?> p-2 rounded border">
                                    <i class="<?= $opt['is_correct'] ? 'fas fa-check-circle' : 'far fa-circle' ?>"></i>
                                    <?= htmlspecialchars($opt['text']) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    let currentOptions = 2;
    function ajouterOption() {
        const container = document.getElementById('options-container');
        const newIndex = currentOptions;
        currentOptions++;
        const nouvelleOption = document.createElement('div');
        nouvelleOption.className = 'flex items-center gap-3 mt-3 animate-fade-in';
        nouvelleOption.innerHTML = `
                <input type="checkbox" name="is_correct[]" value="${newIndex}" class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded cursor-pointer">
                <input type="text" name="options[]" placeholder="Option ${newIndex + 1}" required class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition"><i class="fas fa-trash"></i></button>
            `;
        container.appendChild(nouvelleOption);
    }
</script>
</body>
</html>