<?php

require_once __DIR__ . "/Env.php";
Env::load(__DIR__ . "/../.env");
class Database {

class Database
{
    private static ?PDO $instance = null;

        $host = $_ENV['DB_HOST'] ?? 'localhost';
        $name = $_ENV['DB_NAME'] ?? 'EduQuiz';
        $user = $_ENV['DB_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? '';

        try {
            $pdo = new PDO(
                "mysql:host=" . $host . ";dbname=" . $name,
                $user,
                $pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $host = "localhost";
            $dbname = "EduQuiz";
            $username = "root";
            $password = "";
 self::$instance = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $username,
                $password
            );

            self::$instance->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }

        return self::$instance;
    }
}