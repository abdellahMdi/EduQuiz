<?php

declare(strict_types=1);
require_once __DIR__ . '/../Entities/User.php';
require_once __DIR__ . '/../repositories/UserRepository.php';

class AuthService
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function register(
        string $name,
        string $email,
        string $password,
        string $role
    ): bool {

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $user = new User(
            null,
            $name,
            $email,
            $hashedPassword,
            $role
        );
 return $this->repository->create($user);
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->repository->findByEmail($email);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false; }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'role' => $user['role']
        ];

        return true;
    }
}