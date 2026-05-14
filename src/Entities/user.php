<?php

declare(strict_types=1);

class User
{
    private string $fullname;
    private string $email;
    private string $password;
    private string $role;

    public function __construct(
        string $fullname,
        string $email,
        string $password,
        string $role
    ) {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }
}