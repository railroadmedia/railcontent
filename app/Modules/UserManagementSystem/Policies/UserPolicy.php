<?php

namespace App\Modules\UserManagementSystem\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\UserManagementSystem\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can upload files.
     */
    public function uploadFiles(User $user): bool
    {
        return true;
    }
}
