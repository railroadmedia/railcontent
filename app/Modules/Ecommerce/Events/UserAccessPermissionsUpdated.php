<?php

namespace App\Modules\Ecommerce\Events;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;

class UserAccessPermissionsUpdated
{
    private UserAccessPermissionsCollection $userAccessPermissions;
    private bool $skipRechargeSync = false;

    public function __construct(UserAccessPermissionsCollection $userAccessPermissions, bool $skipRechargeSync = false)
    {
        $this->userAccessPermissions = $userAccessPermissions;
        $this->skipRechargeSync = $skipRechargeSync;
    }

    public function getUserAccessPermissions(): UserAccessPermissionsCollection
    {
        return $this->userAccessPermissions;
    }

    public function getUserId()
    {
        return $this->userAccessPermissions->getUserId();
    }

    public function getSkipRechargeSync(): bool
    {
        return $this->skipRechargeSync;
    }

}
