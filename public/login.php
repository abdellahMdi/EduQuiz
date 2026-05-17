<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/services/AuthService.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    $authService = new AuthService();  $success = $authService->register(
        $name,
        $email,
        $password,
        $role
    );

    if ($success) {
        $message = 'Compte créé avec succès';
    } else {
        $message = 'Erreur lors de inscription';
    }
}
?><h1>Register</h1>

<p><?= $message ?></p>

<?php require_once __DIR__ . '/../src/Views/registerForm.php'; ?>