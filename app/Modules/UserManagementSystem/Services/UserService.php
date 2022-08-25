<?php

namespace App\Modules\UserManagementSystem\Services;

use Modules\UserManagementSystem\Models\User;

class UserService
{

    public function __construct()
    {
    }

    public function getByEmailOrNull(string $email): ?User
    {
        return User::query()->where(['email' => $email])->first();
    }

    public function getByEmailsOrNull(array $emails): ?User
    {
        return User::query()->whereIn('email', $emails)->first();
    }

    public function getByIdOrNull(int $userId): ?User
    {
        return User::query()->find($userId);
    }

    public function getUsersByIds(array $userIds): array
    {
        return User::query()->whereIn('id', $userIds)->get();
    }
}
