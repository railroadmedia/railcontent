<?php

namespace Modules\UserManagementSystem\Events\User;

use InvalidArgumentException;
use Modules\UserManagementSystem\Models\User;

class UserCreated
{
    public function __construct(public User $user, public ?string $originOfCreation = null)
    {
        if ($originOfCreation !== null && !in_array($originOfCreation, ['web', 'musora-app'])) {
            throw new InvalidArgumentException('Invalid origin of creation');
        }
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
