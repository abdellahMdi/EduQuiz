<?php

session_start();

require_once __DIR__ . "/../src/repositories/resultRepostry.php";
// require_once __DIR__ . "/../src/student/quiz_interface.php"; 

$repo = new ResultRepository();

$quiz_id = $_SESSION['quiz_id'] ?? null;

if (!$quiz_id) {
    die("Quiz non sélectionné");
}

$results = $repo->getDashboardResults($quiz_id);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Résultats - Espace Formateur</title>
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

    <div class="max-w-5xl mx-auto px-4 pb-12 space-y-6">
        
        <div class="flex justify-between items-end">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Résultats : <span> Évaluation JavaScript <span></h2>
                <p class="text-gray-500 text-sm mt-1">Code du Quiz : <span class="font-mono bg-gray-200 px-2 rounded">JS-2026-X8</span></p>
            </div>
          
        </div>

    

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                        
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    </tr>
                </thead>
         <tbody>

<?php foreach ($results as $r): ?>

    <tr>

        <td class="px-6 py-4">
            <?= $r['name'] ?>
        </td>

        <td class="px-6 py-4 text-center font-bold">
            <?= $r['score'] ?>/20
        </td>

        <td class="px-6 py-4 text-center">

            <?php if ($r['score'] >= 10): ?>
                <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">
                    Validé
                </span>
            <?php else: ?>
                <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">
                    À revoir
                </span>
            <?php endif; ?>

        </td>

    </tr>

<?php endforeach; ?>

</tbody>
            </table>
        </div>
    </div>
</body>
</html>