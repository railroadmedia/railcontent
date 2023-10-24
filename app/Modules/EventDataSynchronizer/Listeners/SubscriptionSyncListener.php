<?php

namespace App\Modules\EventDataSynchronizer\Listeners;


use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\Ecommerce\Services\SubscriptionService;
use Log;

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
        try {
            if ($userAccessPermissionsUpdated->getSkipRechargeSync()) {
                return;
            }
            //TODO: Move to a job
            $this->subscriptionService->syncSubscriptionData($userAccessPermissionsUpdated->getUserAccessPermissions());
        } catch (\Throwable $e) {
            $userId = $userAccessPermissionsUpdated->getUserId();
            Log::error("Error syncing subscriptions for user: $userId");
            Log::error($e);
        }
    }

}
