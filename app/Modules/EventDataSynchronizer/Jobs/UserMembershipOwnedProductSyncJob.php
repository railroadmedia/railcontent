<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;

class UserMembershipOwnedProductSyncJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    private int $permissionId;
    private bool $syncCustomerIO;
    private ?Carbon $afterDate;

    public function __construct(int $skip, int $take, int $permissionId, bool $syncCustomerIO, ?string $afterDate)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->permissionId = $permissionId;
        $this->syncCustomerIO = $syncCustomerIO;
        $this->afterDate = !empty($afterDate) ? new Carbon($afterDate) : null;
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
        $query = UserAccessPermission::query()->select('user_id')->distinct();
        if ($this->permissionId) {
            $query = $query->where('permission_id', '=', $this->permissionId);
        }
        if ($this->afterDate) {
            $query = $query->where('start_time', '>', $this->afterDate);
        }
        return $query;
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        /** @var UserMembershipFieldsService $userMembershipFieldsService */
        $userMembershipFieldsService = app()->make(UserMembershipFieldsService::class);
        $userIds = $items->map(function ($item) {
            return $item->user_id;
        })->toArray();

        foreach ($userIds as $userId) {
            $userMembershipFieldsService->sync($userId);
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
