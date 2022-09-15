<?php

namespace App\Modules\EventDataSynchronizer\Events;

use Modules\UserManagementSystem\Models\User;

class UserMembershipDateUpdated
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

}
