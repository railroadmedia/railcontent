<?php

namespace App\Modules\EventDataSynchronizer\Listeners;

use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;

class UserMembershipFieldsListener
{
    private UserMembershipFieldsService $userMembershipFieldsService;

    public function __construct(UserMembershipFieldsService $userMembershipFieldsService)
    {
        $this->userMembershipFieldsService = $userMembershipFieldsService;
    }

    public function handleUserAccessPermissionsUpdated(UserAccessPermissionsUpdated $userAccessPermissionsUpdated): void
    {
        $this->userMembershipFieldsService->syncUserAccess($userAccessPermissionsUpdated->getUserAccessPermissions());
    }
}
