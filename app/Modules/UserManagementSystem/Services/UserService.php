<?php

namespace App\Modules\UserManagementSystem\Services;

use Modules\UserManagementSystem\Events\User\UserCreated;
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

    public function getUserByShopifyCustomerId($shopifyCustomerId): ?User
    {
        $user = User::query()->where('shopify_id', '=', $shopifyCustomerId)->first('id');
        return $user ?? null;
    }

    public function createUser(string $email, string $password, ?int $shopifyCustomerId = null, bool $requiresPasswordUpdate = false): User
    {
        $parts = explode('@', $email);

        $user = new User();
        $user->email = $email;
        $user->setPassword($password);
        $user->display_name = $parts[0] . rand(10000, 99999);
        $user->shopify_id = $shopifyCustomerId;
        $user->requires_password_update = $requiresPasswordUpdate;
        $user->save();
        event(new UserCreated($user));
        return $user;
    }
}
