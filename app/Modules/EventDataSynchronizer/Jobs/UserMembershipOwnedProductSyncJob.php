<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\Ecommerce\Services\QueryServices;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventDataSynchronizer\Listeners\UserProductToUserContentPermissionListener;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;

class UserMembershipOwnedProductSyncJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    private bool $syncCustomerIO;
    private bool $syncContentPermissions;
    private $customQuery;
    private $customQueryParameter;

    public function __construct(
        int $skip,
        int $take,
        $customQuery,
        $customQueryParameter,
        bool $syncContentPermissions,
        bool $syncCustomerIO
    ) {
        $this->skip = $skip;
        $this->take = $take;

        $this->syncContentPermissions = $syncContentPermissions;
        $this->syncCustomerIO = $syncCustomerIO;
        $this->customQuery = $customQuery;
        $this->customQueryParameter = $customQueryParameter;
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
        return QueryServices::getCustomUserQuery($this->customQuery, $this->customQueryParameter);
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
            return $item->id;
        })->toArray();

        foreach ($userIds as $userId) {
            $userAccessPermissions = $userAccessPermissionsService->getUserAccessPermissions($userId);
            $userMembershipFieldsService->syncUserAccess($userAccessPermissions);
            if ($this->syncContentPermissions) {
                $userContentListenerService->syncContentPermissions($userId, $userAccessPermissions);
            }
        }

        if ($this->syncCustomerIO) {
            foreach ($userIds as $userId) {
                $user = new User();
                $user->id = $userId;
                dispatch(
                    (new CustomerIoSyncUserByUserId($user))
                        ->delay(Carbon::now()->addSeconds(3))
                );
            }
        }
        return true;
    }
}
