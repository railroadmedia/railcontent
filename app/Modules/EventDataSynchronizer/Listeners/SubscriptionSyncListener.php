<?php

namespace App\Modules\EventDataSynchronizer\Listeners;


use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\Ecommerce\Services\SubscriptionService;

class SubscriptionSyncListener
{


    private SubscriptionService $subscriptionService;

    public function __construct(
        SubscriptionService $subscriptionService
    ) {
        $this->subscriptionService = $subscriptionService;
    }

    public function handleUserAccessPermissionsUpdated(UserAccessPermissionsUpdated $userAccessPermissionsUpdated): void
    {
        $this->subscriptionService->syncSubscriptionData($userAccessPermissionsUpdated->getUserAccessPermissions());
    }

}
