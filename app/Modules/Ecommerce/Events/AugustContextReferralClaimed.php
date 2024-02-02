<?php

namespace App\Modules\Ecommerce\Events;

use App\Modules\Ecommerce\Collections\OrderCollection;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use Illuminate\Support\Collection;

class UserAccessPermissionsUpdated
{
    private UserAccessPermissionsCollection $userAccessPermissions;
    private ?OrderCollection $orders;
    private $subscriptions;

    public function __construct(
        UserAccessPermissionsCollection $userAccessPermissions,
        ?OrderCollection $orders,
        $subscriptions
    ) {
        $this->userAccessPermissions = $userAccessPermissions;
        $this->orders = $orders;
        $this->subscriptions = $subscriptions;
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

    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

}
