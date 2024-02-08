<?php

namespace App\Modules\UserManagementSystem\Services;

use Modules\UserManagementSystem\Models\User;

class UserAuthenticationService
{

    public function __construct()
    {
    }

    public function authenticate(string $email, string $password): bool
    {
        return auth()->guard('user-management-system')
            ->validate(['email' => $email, 'password' => $password]);
    }

    public function login(User $user): void
    {
        auth()->loginUsingId($user->getId(), true);
    }
}
