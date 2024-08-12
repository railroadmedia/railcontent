<?php

namespace Modules\UserManagementSystem\Events;

use Modules\UserManagementSystem\Models\User;

class MobileAppLogin
{
    /**
     * @var User
     */
    private $user;

    private $firebaseToken;

    private $platform;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, $firebaseToken = null, $platform = null)
    {
        $this->user = $user;
        $this->firebaseToken = $firebaseToken;
        $this->platform = $platform;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getFirebaseToken(): ?string
    {
        return $this->firebaseToken;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }
}
