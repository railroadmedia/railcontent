<?php

namespace App\Modules\EventDataSynchronizer\Listeners;

use App\Modules\Content\Models\UserPermission;
use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Carbon\Carbon;

class UserProductToUserContentPermissionListener
{
    private ContentPermissionsService $contentPermissionsService;
    private UserAccessPermissionsService $userAccessPermissionsService;

    public function __construct(
        ContentPermissionsService $contentPermissionsService,
        UserAccessPermissionsService $userAccessPermissionsService
    ) {
        $this->contentPermissionsService = $contentPermissionsService;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    public function handleUserAccessPermissionsUpdated(UserAccessPermissionsUpdated $userAccessPermissionsUpdated): void
    {
        $this->syncContentPermissions(
            $userAccessPermissionsUpdated->getUserId(),
            $userAccessPermissionsUpdated->getUserAccessPermissions()
        );
    }

    public function syncContentPermissions(int $userId, UserAccessPermissionsCollection $userAccessPermissions): void
    {
        $permissionIds = $userAccessPermissions->getActivePermissionIds();
        $existingUserPermissions = $this->contentPermissionsService->getUserPermissions($userId)->keyBy(
            'permission_id'
        );


        $toDeleteIds = $existingUserPermissions->where(function ($item, $key) use ($permissionIds) {
            return !in_array($key, $permissionIds);
        })->pluck('id')->toArray();

        foreach ($permissionIds as $permissionId) {
            list($startDate, $expirationDate) = $userAccessPermissions->getActiveDates($permissionId);
            $userPermission = $existingUserPermissions[$permissionId] ?? null;
            if (!$userPermission) {
                $userPermission = new UserPermission();
                $userPermission->user_id = $userId;
                $userPermission->permission_id = $permissionId;
                $userPermission->created_on = Carbon::now();
            }
            if ($userPermission->start_date != $startDate || $userPermission->expiration_date != $expirationDate) {
                $userPermission->start_date = $startDate;
                $userPermission->expiration_date = $expirationDate;
                $userPermission->updated_on = Carbon::now();
                $userPermission->save();
            }
        }

        UserPermission::query()->whereIn('id', $toDeleteIds)->delete();
    }

    public function syncUserId($userId): void
    {
        $userAccessPermissions = $this->userAccessPermissionsService->getUserAccessPermissions($userId);
        $this->syncContentPermissions($userId, $userAccessPermissions);
    }
}
