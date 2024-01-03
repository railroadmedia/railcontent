<?php

namespace App\Modules\EventTracking\Events;

use Modules\UserManagementSystem\Models\User;

class ReferralPageViewed
{
    private User $user;
    private string $brand;
    private string $referralCode;

    public function __construct(User $user, string $brand, string $referralCode)
    {
        $this->user = $user;
        $this->brand = $brand;
        $this->referralCode = $referralCode;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getReferralCode(): string
    {
        return $this->referralCode;
    }
}
