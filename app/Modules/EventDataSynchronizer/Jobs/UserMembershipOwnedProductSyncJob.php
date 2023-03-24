<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Illuminate\Database\Eloquent\Builder;

class UserMembershipOwnedProductSyncJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    private int $productId;

    public function __construct(int $skip, int $take, int $productId)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->productId = $productId;
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
      $test =   $query->toSql();
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
        return true;
    }
}
