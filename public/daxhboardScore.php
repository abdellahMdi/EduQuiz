dashboard_formateur.ph
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
                <h2 class="text-2xl font-bold text-gray-800">Résultats : Évaluation JavaScript</h2>
                <p class="text-gray-500 text-sm mt-1">Code du Quiz : <span class="font-mono bg-gray-200 px-2 rounded">JS-2026-X8</span></p>
            </div>
            <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition">
                <i class="fas fa-file-csv mr-2"></i> Exporter (CSV)
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-lg text-2xl mr-4"><i class="fas fa-users"></i></div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Participants</p>
                    <p class="text-2xl font-bold text-gray-800">24</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                <div class="p-3 bg-green-100 text-green-600 rounded-lg text-2xl mr-4"><i class="fas fa-chart-line"></i></div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Moyenne de la classe</p>
                    <p class="text-2xl font-bold text-gray-800">14.5<span class="text-sm text-gray-500">/20</span></p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                <div class="p-3 bg-red-100 text-red-600 rounded-lg text-2xl mr-4"><i class="fas fa-exclamation-triangle"></i></div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">En difficulté (< 10/20)</p>
                    <p class="text-2xl font-bold text-red-600">3 <span class="text-sm text-gray-500 font-normal">étudiants</span></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">Nisrina</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">nisrina@student.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-bold text-gray-800">18/20</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Validé</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 bg-red-50/20">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">Anonyme</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">anonyme@student.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-bold text-red-600">08/20</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">À revoir</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>