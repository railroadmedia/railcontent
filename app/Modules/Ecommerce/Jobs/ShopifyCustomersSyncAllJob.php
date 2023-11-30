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
    private int $startId;
    private int $endId;
    private string $customQuery;
    /**
     * @var false
     */
    private bool $skipEventSync;

    public function __construct(
        int $skip,
        int $take,
        int $startId,
        int $endId,
        $customQuery = '',
        $skipEventSync = false
    ) {
        $this->skip = $skip;
        $this->take = $take;
        $this->startId = $startId;
        $this->endId = $endId;
        $this->customQuery = $customQuery ?? "";
        $this->skipEventSync = $skipEventSync;
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
        $query = User::query();

        switch ($this->customQuery) {
            case "hasRechargeSubscription":
                $query = $query->where('has_recharge_subscription', true);
                break;
            case "futureMembershipIssue":
                $query = $query->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('railcontent_user_permissions')
                        ->whereRaw('railcontent_user_permissions.user_id = usora_users.id')
                        ->whereIn('railcontent_user_permissions.permission_id', [91, 92])
                        ->where('railcontent_user_permissions.start_date', '>', Carbon::now()->addDays(1));
                });
                break;
            case "":
                break;
            default:
                throw new \Exception("Invalid custom query: $this->customQuery");
        }
        if ($this->startId) {
            $query = $query->where('id', '>=', $this->startId);
        }
        if ($this->endId) {
            $query = $query->where('id', '<=', $this->endId);
        }
        return $query;
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        $shopifySyncService = app(ShopifySyncService::class);
        foreach ($items as $item) {
            try {
                $shopifySyncService->syncCustomerByUser(
                    $item,
                    isRebuildingPermissions: false,
                    skipEventSync: $this->skipEventSync
                );
            } catch (\Throwable $ex) {
                Log::error("Error syncing shopify user $item->shopify_id: user:$item->id");
                Log::error($ex);
            }
        }
        return true;
    }
}
