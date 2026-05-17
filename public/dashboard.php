<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/functions/auth.php';

requireAuth();
?>

<h1>Dashboard</h1>

<p>
    Bienvenue <?= $_SESSION['user']['name']; ?>
</p>

<p>
    Role : <?= $_SESSION['user']['role']; ?></p>

<a href="logout.php">Logout</a>