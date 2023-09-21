<?php

namespace App\Modules\Ecommerce\Events;

use Illuminate\Support\Collection;

class UserAccessPermissionsUpdated
{
    private int $userId;
    private Collection $userAccessPermissions;

    public function __construct(int $userId, Collection $userAccessPermissions)
    {
        $this->userId = $userId;
        $this->userAccessPermissions = $userAccessPermissions;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserAccessPermissions(): Collection
    {
        return $this->userAccessPermissions;
    }

}
