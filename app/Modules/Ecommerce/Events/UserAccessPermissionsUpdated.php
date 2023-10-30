<?php

namespace App\Modules\Ecommerce\Events;

use App\Modules\Ecommerce\Collections\OrderCollection;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use Illuminate\Support\Collection;

class UserAccessPermissionsUpdated
{
    private UserAccessPermissionsCollection $userAccessPermissions;
    private ?OrderCollection $orders;
    private $currentSubscription;

    public function __construct(
        UserAccessPermissionsCollection $userAccessPermissions,
        ?OrderCollection $orders,
        $currentSubscription
    ) {
        $this->userAccessPermissions = $userAccessPermissions;
        $this->orders = $orders;
        $this->currentSubscription = $currentSubscription;
    }

    public function getUserAccessPermissions(): UserAccessPermissionsCollection
    {
        return $this->userAccessPermissions;
    }

    public function getUserId()
    {
        return $this->userAccessPermissions->getUserId();
    }

    public function getOrderCollection(): ?OrderCollection
    {
        return $this->orders;
    }

    public function getCurrentSubscription()
    {
        return $this->currentSubscription;
    }

}
