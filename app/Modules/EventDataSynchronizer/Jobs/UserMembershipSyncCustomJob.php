<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Content\Models\UserPermission;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventDataSynchronizer\Listeners\UserProductToUserContentPermissionListener;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;

class UserMembershipSyncCustomJob extends BatchQueryJob
{
    private int $skip;
    private int $take;


    public function __construct(
        int $skip,
        int $take,
    ) {
        $this->skip = $skip;
        $this->take = $take;
    }

    function getSkip(): int
    {
        return $this->skip;
    }

    function getTake(): int
    {
        return $this->take;
    }

    function getQuery(): Builder
    {
        $query = UserPermission::query()->select('user_id')->distinct()
            ->join('usora_users', function ($join) {
                $join->on('usora_users.id', '=', 'railcontent_user_permissions.user_id')
                    ->on('usora_users.membership_expiration_date', '>', 'railcontent_user_permissions.expiration_date');
            })
            ->whereIn('permission_id', [91, 92])
            ->where('usora_users.membership_expiration_date', '>', Carbon::now())
            ->where('usora_users.access_level', '!=', 'lifetime');
        return $query;
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        /** @var UserMembershipFieldsService $userMembershipFieldsService */
        $userMembershipFieldsService = app()->make(UserMembershipFieldsService::class);
        /** @var UserProductToUserContentPermissionListener $userContentListenerService */
        $userContentListenerService = app()->make(UserProductToUserContentPermissionListener::class);
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app()->make(UserAccessPermissionsService::class);

        $userIds = $items->map(function ($item) {
            return $item->user_id;
        })->toArray();

        foreach ($userIds as $userId) {
            $userAccessPermissions = $userAccessPermissionsService->getUserAccessPermissions($userId);
            if ($userAccessPermissions->getCollection()->count() > 0) {
                $userMembershipFieldsService->syncUserAccess($userAccessPermissions);
                $userContentListenerService->syncContentPermissions($userId, $userAccessPermissions);
            } else {
                \Log::error("User $userId has no access permissions");
            }
        }

//        if ($this->syncCustomerIO) {
//            foreach ($userIds as $userId) {
//                $user = new User();
//                $user->id = $userId;
//                dispatch(
//                    (new CustomerIoSyncUserByUserId($user))
//                        ->delay(Carbon::now()->addSeconds(3))
//                );
//            }
//        }
        return true;
    }
}
