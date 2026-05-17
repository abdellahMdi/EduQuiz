<?php

declare(strict_types=1);

session_start();

function isAuthenticated(): bool
{
    return isset($_SESSION['user']);
}

function logout(): void
{session_destroy();
}

function requireAuth(): void
{
    if (!isAuthenticated()) {
        header('Location: login.php');
        exit;
    }
}