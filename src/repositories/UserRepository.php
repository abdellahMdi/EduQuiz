<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../Entities/User.php';

class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }
    public function create(User $user): bool
    {
        $sql = "INSERT INTO users(name, email, password, role)
                VALUES(:name, :email, :password, :role)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':role' => $user->getRole()
        ]);
    }
    public function findByEmail(string $email): array|false
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}