<?php

namespace App\Application\UseCases;

use App\Models\User;

class CreateUser
{
    public function execute(string $name, string $email): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt('password'),
        ]);
    }
}
