<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EduQuiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col">

<nav class="bg-white shadow-sm px-6 py-4 w-full">
    <div class="max-w-5xl mx-auto flex justify-center md:justify-start items-center">
        <h1 class="text-xl font-bold text-blue-600"><i class="fas fa-graduation-cap mr-2"></i>EduQuiz</h1>
    </div>
</nav>

<div class="flex-grow flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 w-full max-w-md">

        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-600 mb-4">
                <i class="fas fa-user-lock text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Bienvenue !</h2>
            <p class="text-sm text-gray-500 mt-2">Connectez-vous à votre espace (Formateur ou Étudiant)</p>
        </div>

        <form action="#" method="POST" class="space-y-5">

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" id="email" name="email" required placeholder="exemple@codeacademy.com"
                           class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <a href="#" class="text-xs font-medium text-blue-600 hover:text-blue-800 transition">Mot de passe oublié ?</a>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password" required placeholder="••••••••"
                           class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition duration-200 flex items-center justify-center gap-2 mt-4">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-600 border-t pt-6">
            Vous n'avez pas de compte ?
            <a href="#" class="font-medium text-blue-600 hover:text-blue-800 transition">S'inscrire ici</a>
        </div>

    </div>
</div>

</body>
</html>