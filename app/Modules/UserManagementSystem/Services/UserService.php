<?php

namespace App\Modules\UserManagementSystem\Services;

use Modules\UserManagementSystem\Models\User;

class UserService
{

    public function __construct()
    {
    }

    public function getUserOrNullByEmail(string $email): ?User
    {
        return User::query()->where(['email' => $email])->first();
    }
}
