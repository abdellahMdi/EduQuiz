<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/services/AuthService.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = isset($_POST['name'])
        ? trim($_POST['name'])
        : '';

    $email = isset($_POST['email'])
        ? trim($_POST['email'])
        : '';

    $password = isset($_POST['password'])
        ? trim($_POST['password'])
        : '';

    $role = isset($_POST['role'])
        ? trim($_POST['role'])
        : '';

    if (
        empty($name) ||
        empty($email) ||
        empty($password) ||
        empty($role)
    ) {

        $message = "Tous les champs sont obligatoires";

    } else {

        $authService = new AuthService();

        $success = $authService->register(
            $name,
            $email,
            $password,
            $role
        );

        if ($success) {

            $message = "Compte créé avec succès";

        } else {

            $message = "Erreur lors de l'inscription";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">

        <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">
            Register
        </h1>

        <?php if (!empty($message)) : ?>
            <p class="mb-4 text-center text-sm text-red-500">
                <?= $message ?>
            </p>
        <?php endif; ?>

        <form method="POST" class="space-y-4">

            <input
                type="text"
                name="name"
                placeholder="Nom"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <input
                type="email"
                name="email"
                placeholder="Email"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <select
                name="role"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition"
            >
                Register
            </button>

        </form>

    </div>

</body>

</html>