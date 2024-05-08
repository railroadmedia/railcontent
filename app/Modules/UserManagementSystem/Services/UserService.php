<?php

namespace App\Modules\UserManagementSystem\Services;

use Carbon\Carbon;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;

class UserService
{
    public function __construct()
    {
    }

    public function getByEmailOrNull(string $email)
    : ?User {
        return User::query()
            ->where(['email' => $email])
            ->first();
    }

    public function getByEmailsOrNull(array $emails)
    : ?User {
        return User::query()
            ->whereIn('email', $emails)
            ->first();
    }

    public function getByIdOrNull(int $userId)
    : ?User {
        return User::query()
            ->find($userId);
    }

    public function getUsersByIds(array $userIds)
    : array {
        return User::query()
            ->whereIn('id', $userIds)
            ->get();
    }

    public function createUser(
        string $email,
        string $password,
        ?int $shopifyCustomerId = null,
        bool $requiresPasswordUpdate = false
    )
    : User {
        $parts = explode('@', $email);

        $user = new User();
        $user->email = $email;
        $user->setPassword($password);
        $user->display_name = $parts[0].rand(10000, 99999);
        $user->shopify_id = $shopifyCustomerId;
        $user->requires_password_update = $requiresPasswordUpdate;
        $user->save();
        event(new UserCreated($user));

        return $user;
    }

    public function setTrialPeriod($shopifyCustomerId, $trialExpirationDate)
    {
        $user = $this->getUserByShopifyCustomerId($shopifyCustomerId);
        $user->trial_expiration_date = $trialExpirationDate;
        $user->is_trial = true;
        $user->save();
    }

    public function getUserByShopifyCustomerId($shopifyCustomerId)
    : ?User {
        $user =
            User::query()
                ->where('shopify_id', '=', $shopifyCustomerId)
                ->orderByDesc('id')
                ->first();

        return $user ?? null;
    }

    public function deleteUser($user)
    {
        $user->fill([
                        'email' => 'musora+deleted_'.
                            Carbon::now()
                                ->getTimestamp().
                            '@musora.com',
                        'first_name' => null,
                        'last_name' => null,
                        'display_name' => '',
                        'gender' => null,
                        'country' => null,
                        'region' => null,
                        'city' => null,
                        'birthday' => null,
                        'phone_number' => null,
                        'profile_picture_url' => null,
                        'timezone' => null,
                        'permission_level' => null,
                        'drums_gear_photo' => null,
                        'biography' => null,
                        'piano_gear_photo' => null,
                        'drums_gear_set_brands' => null,
                        'drums_gear_hardware_brands' => null,
                        'drums_gear_stick_brands' => null,
                        'drums_gear_cymbal_brands' => null,
                        'drums_playing_since_year' => null,
                        'piano_gear_piano_brands' => null,
                        'piano_gear_keyboard_brands' => null,
                        'piano_playing_since_year' => null,
                        'guitar_gear_string_brands' => null,
                        'guitar_gear_pedal_brands' => null,
                        'guitar_gear_amp_brands' => null,
                        'guitar_gear_guitar_brands' => null,
                        'guitar_gear_photo' => null,
                        'singing_gear_mic_brands' => null,
                        'singing_gear_photo' => null,

                    ]);
        $user->updated_at =
            Carbon::now()
                ->toDateTimeString();

        $user->save();

        return $user;
    }
}
