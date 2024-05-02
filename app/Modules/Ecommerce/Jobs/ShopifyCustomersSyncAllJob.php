<?php

namespace App\Modules\Ecommerce\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Console\Commands\Infrastructure\BatchQueryJobByIds;
use App\Models\ShopifySync;
use App\Modules\Ecommerce\Enums\SubscriptionIntervalType;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\QueryServices;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class ShopifyCustomersSyncAllJob extends BatchQueryJobByIds
{
    private int $skip;
    private int $take;
    protected array $ids;

    private int $startId;
    private int $endId;
    private string $customQuery;
    /**
     * @var false
     */
    private bool $skipEventSync;
    private $customQueryParameter;

    public function __construct(
        int $skip,
        int $take,
        int $startId,
        int $endId,
        $customQuery = '',
        $customQueryParameter = '',
        $skipEventSync = false
    ) {
        $this->skip = $skip;
        $this->take = $take;
        $this->startId = $startId;
        $this->endId = $endId;
        $this->customQuery = $customQuery ?? "";
        $this->customQueryParameter = $customQueryParameter;
        $this->skipEventSync = $skipEventSync;
        $this->init($skip, $take);
    }

    public function getSkip(): int
    {
        return $this->skip;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    public function getIds(): array
    {
        return $this->ids;
    }

    public function getQuery(): Builder
    {
        return QueryServices::getCustomUserQuery(
            $this->customQuery,
            $this->customQueryParameter,
            $this->startId,
            $this->endId
        );
    }

    public function handleItem($item): void
    {
    }

    public function handleAllItems($items): bool
    {
        $shopifySyncService = app(ShopifySyncService::class);
        foreach ($items as $item) {
            try {
                $shopifySyncService->syncCustomerByEmail($item->email);
            } catch (\Throwable $ex) {
                Log::error("Error syncing shopify user $item->shopify_id: user:$item->id");
                Log::error($ex);
            }
        }
        return true;
    }
}
