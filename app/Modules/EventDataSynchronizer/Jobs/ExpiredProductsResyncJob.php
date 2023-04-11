<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ExpiredProductsResyncJob extends BatchQueryJob
{
    private int $skip;
    private int $take;

    public function __construct(int $skip, int $take)
    {
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
        $startDate = Carbon::today()->addDays(11);
        $endDate = $startDate->addDays(1);
        return UserProduct::query()
            ->select("user_id")
            ->where("expiration_date", ">=", $startDate)
            ->where("expiration_date", "<=", $endDate);
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        $userMembershipFieldsService = app()->make(UserMembershipFieldsService::class);
        $userIds = $items->map(function ($item) {
            return $item->user_id;
        })->toArray();
        $userMembershipFieldsService->syncUserIds($userIds);
        return true;
    }
}
