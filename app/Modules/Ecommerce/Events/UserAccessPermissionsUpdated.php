<?php

namespace App\Modules\Ecommerce\Events;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;

class UserAccessPermissionsUpdated
{
    private UserAccessPermissionsCollection $userAccessPermissions;

    public function __construct(UserAccessPermissionsCollection $userAccessPermissions)
    {
        $this->userAccessPermissions = $userAccessPermissions;
    }

    public function getUserAccessPermissions(): UserAccessPermissionsCollection
    {
        return $this->userAccessPermissions;
    }

    public function getUserId()
    {
        return $this->userAccessPermissions->getUserId();
    }

}
