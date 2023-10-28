<?php

namespace App\Modules\Ecommerce\Events;

use App\Modules\Ecommerce\Collections\OrderCollection;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use Illuminate\Support\Collection;

class UserAccessPermissionsUpdated
{
    private UserAccessPermissionsCollection $userAccessPermissions;
    private OrderCollection $orders;

    public function __construct(
        UserAccessPermissionsCollection $userAccessPermissions,
        OrderCollection $orders = null
    ) {
        $this->userAccessPermissions = $userAccessPermissions;
        $this->orders = $orders;
    }

    public function getUserAccessPermissions(): UserAccessPermissionsCollection
    {
        return $this->userAccessPermissions;
    }

    public function getUserId()
    {
        return $this->userAccessPermissions->getUserId();
    }

    public function getOrderCollection(): OrderCollection
    {
        return $this->orders;
    }

}
