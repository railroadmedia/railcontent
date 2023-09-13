<?php

namespace App\Modules\EventDataSynchronizer\Listeners;

use App\Modules\Ecommerce\Events\UserProductsUpdated;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;

class UserMembershipFieldsListener
{
    private UserMembershipFieldsService $userMembershipFieldsService;

    public function __construct(UserMembershipFieldsService $userMembershipFieldsService)
    {
        $this->userMembershipFieldsService = $userMembershipFieldsService;
    }


    public function handleUserProductsUpdated(UserProductsUpdated $userProductsUpdated)
    {
        $this->userMembershipFieldsService->sync($userProductsUpdated->getUserId());
    }
}
