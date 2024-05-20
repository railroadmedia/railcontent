<?php

namespace App\Modules\Ecommerce\Events;

use App\Modules\Ecommerce\Models\AccessCode;
use Modules\UserManagementSystem\Models\User;

class AccessCodeClaimed
{
    private AccessCode $accessCode;
    private User $user;
    private ?string $context;

    public function __construct(AccessCode $accessCode, User $user, ?string $context)
    {
        $this->accessCode = $accessCode;
        $this->user = $user;
        $this->context = $context;
    }

    public function getAccessCode(): AccessCode
    {
        return $this->accessCode;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }
}
