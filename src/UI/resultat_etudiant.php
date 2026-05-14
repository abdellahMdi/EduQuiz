<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du Quiz - Espace Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

<nav class="bg-white shadow-sm px-6 py-4 mb-8">
    <div class="max-w-5xl mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600"><i class="fas fa-graduation-cap mr-2"></i>EduQuiz</h1>
        <span class="text-sm text-gray-500">Espace Étudiant</span>
    </div>
</nav>

<div class="max-w-3xl mx-auto px-4 pb-12 space-y-6">

    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Quiz Terminé : JavaScript Avancé</h2>
        <p class="text-gray-500 mb-6">Voici votre résultat final.</p>

        <div class="inline-flex items-center justify-center w-32 h-32 rounded-full border-8 border-blue-500 bg-blue-50 text-4xl font-bold text-blue-700 shadow-inner">
            15<span class="text-2xl text-blue-400">/20</span>
        </div>

        <p class="mt-6 text-green-600 font-medium"><i class="fas fa-check-circle mr-1"></i> Bravo ! Vous avez validé ce module.</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Correction Détaillée</h3>

        <div class="space-y-4">
            <div class="border border-green-200 bg-green-50/30 rounded-lg p-5 border-l-4 border-l-green-500">
                <h4 class="font-medium text-gray-800 mb-3"><span class="text-green-600 font-bold mr-2">Q1.</span> Quels sont les types de variables en JS ?</h4>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2 text-green-700 bg-green-100 p-2 rounded">
                        <i class="fas fa-check-square"></i> let (Votre réponse)
                    </li>
                    <li class="flex items-center gap-2 text-gray-500 p-2">
                        <i class="far fa-square"></i> int
                    </li>
                </ul>
            </div>

            <div class="border border-red-200 bg-red-50/30 rounded-lg p-5 border-l-4 border-l-red-500">
                <h4 class="font-medium text-gray-800 mb-3"><span class="text-red-600 font-bold mr-2">Q2.</span> Comment déclarer une constante ?</h4>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2 text-red-700 bg-red-100 p-2 rounded">
                        <i class="fas fa-times-circle"></i> constant x = 5; (Votre réponse)
                    </li>
                    <li class="flex items-center gap-2 text-green-700 bg-green-100 p-2 rounded mt-1 border border-green-200">
                        <i class="fas fa-arrow-right"></i> const x = 5; (Bonne réponse)
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
            Retour au tableau de bord
        </button>
    </div>
</div>
</body>
</html>