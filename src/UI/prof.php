<?php
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
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">1. Paramètres du Quiz</h2>
            <form action="#" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Titre du Quiz</label>
                    <input type="text" placeholder="Ex: Évaluation JavaScript" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea rows="3" placeholder="Description de l'évaluation..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Code d'accès (Généré)</label>
                    <div class="flex bg-gray-100 rounded-lg p-1 border border-gray-200">
                        <input type="text" value="JS-2026-X8" readonly class="bg-transparent w-full px-2 text-gray-600 font-mono text-center outline-none">
                    </div>
                </div>
                <button type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition duration-200">
                    Enregistrer le Quiz
                </button>
            </form>
        </div>
    </div>

    <div class="md:col-span-2 space-y-6">

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-blue-500">
            <h2 class="text-lg font-semibold mb-4">2. Ajouter une Question</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Votre question</label>
                    <textarea rows="2" placeholder="Saisissez la question ici..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Options de réponse (Cochez les bonnes réponses)</label>

                    <div id="options-container" class="space-y-3">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 cursor-pointer" title="Marquer comme correcte">
                            <input type="text" placeholder="Option 1" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <button type="button" class="text-red-500 hover:bg-red-50 p-2 rounded-lg opacity-50 cursor-not-allowed"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="checkbox" class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 cursor-pointer" title="Marquer comme correcte">
                            <input type="text" placeholder="Option 2" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <button type="button" class="text-red-500 hover:bg-red-50 p-2 rounded-lg opacity-50 cursor-not-allowed"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>

                    <button type="button" onclick="ajouterOption()" class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                        <i class="fas fa-plus-circle"></i> Ajouter une option supplémentaire
                    </button>
                </div>

                <div class="flex justify-end mt-4 pt-4 border-t">
                    <button type="button" class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-lg font-medium transition duration-200">
                        Ajouter la question
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold mb-4">3. Questions du Quiz (Aperçu)</h2>

            <div class="border border-gray-200 rounded-lg p-4 mb-3 relative group">
                <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                    <button class="text-gray-400 hover:text-blue-500"><i class="fas fa-edit"></i></button>
                    <button class="text-gray-400 hover:text-red-500"><i class="fas fa-trash"></i></button>
                </div>

                <h3 class="font-medium text-gray-800 mb-3"><span class="text-blue-600 font-bold mr-2">Q1.</span> Quels sont les types de variables en JS ?</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2 text-green-700 bg-green-50 p-2 rounded border border-green-200">
                        <i class="fas fa-check-circle"></i> let
                    </li>
                    <li class="flex items-center gap-2 text-gray-600 bg-gray-50 p-2 rounded border border-gray-100">
                        <i class="far fa-circle"></i> int
                    </li>
                    <li class="flex items-center gap-2 text-green-700 bg-green-50 p-2 rounded border border-green-200">
                        <i class="fas fa-check-circle"></i> const
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>

<script>
    function ajouterOption() {
        const container = document.getElementById('options-container');
        const optionsCount = container.children.length + 1;

        const nouvelleOption = document.createElement('div');
        nouvelleOption.className = 'flex items-center gap-3 mt-3 animate-fade-in';
        nouvelleOption.innerHTML = `
                <input type="checkbox" name="is_correct[]" class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 cursor-pointer" title="Marquer comme correcte">
                <input type="text" name="options[]" placeholder="Option ${optionsCount}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition"><i class="fas fa-trash"></i></button>
            `;
        container.appendChild(nouvelleOption);
    }
</script>
</body>
</html>


