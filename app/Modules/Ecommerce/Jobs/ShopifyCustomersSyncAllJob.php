<?php

namespace App\Modules\Ecommerce\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Models\ShopifySync;
use App\Modules\Ecommerce\Enums\SubscriptionIntervalType;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class ShopifyCustomersSyncAllJob extends BatchQueryJob
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
        return User::query()->whereNotNull('shopify_id');
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        $shopifySyncService = app(ShopifySyncService::class);
        foreach ($items as $item) {
            try {
                $shopifySyncService->syncCustomerByEmail($item->email);
            } catch (\Throwable $ex) {
                Log::error("Error syncing shopify customer $item->shopify_id: user:$item->id");
                Log::error($ex);
            }
        }
        return true;
    }
}
