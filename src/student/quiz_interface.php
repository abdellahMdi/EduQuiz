<?php

session_start();

$quiz_id = $_GET['quiz_id'] ?? null;

if (!$quiz_id) {
    die("Quiz introuvable");
}

// store in session
$_SESSION['quiz_id'] = $quiz_id;

// redirect to dashboard
header("Location: ../../public/daxhboardScore.php");
exit;
?>