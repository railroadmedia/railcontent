<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;

class UserMembershipOwnedProductSyncJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    private int $productId;
    private bool $syncCustomerIO;
    private ?Carbon $purchasedAfter;

    public function __construct(int $skip, int $take, int $productId, bool $syncCustomerIO, ?string $purchasedAfter)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->productId = $productId;
        $this->syncCustomerIO = $syncCustomerIO;
        $this->purchasedAfter = !empty($purchasedAfter) ? new Carbon($purchasedAfter) : null;
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
        $query = UserProduct::query()->select('user_id');
        if ($this->productId) {
            $query = $query->where('product_id', '=', $this->productId);
        }
        if ($this->purchasedAfter) {
            $query = $query->where('created_at', '>', $this->purchasedAfter);
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

        $userMembershipFieldsService->syncUserIds($userIds);

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
