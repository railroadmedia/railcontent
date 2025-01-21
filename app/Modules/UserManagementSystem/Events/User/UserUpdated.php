<?php

namespace Modules\UserManagementSystem\Events\User;

use Modules\UserManagementSystem\Models\User;

class UserUpdated
{
    /**
     * @var User
     */
    private $newUser;

    /**
     * @var User
     */
    private $oldUser;

    /**
     * Create a new event instance.
     */
    public function __construct(User $newUser, User $oldUser)
    {
        $this->newUser = $newUser;
        $this->oldUser = $oldUser;
    }

    public function getNewUser(): User
    {
        return $this->newUser;
    }

    public function getOldUser(): User
    {
        return $this->oldUser;
    }
}
