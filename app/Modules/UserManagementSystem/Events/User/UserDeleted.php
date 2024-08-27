<?php

namespace Modules\UserManagementSystem\Events\User;

use Modules\UserManagementSystem\Models\User;

class UserDeleted
{
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
