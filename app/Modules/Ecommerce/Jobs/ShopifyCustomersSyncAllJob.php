<?php

namespace App\Modules\Ecommerce\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Console\Commands\Infrastructure\BatchQueryJobByIds;
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
        $this->init($skip, $take);
    }

    function getSkip(): int
    {
        return $this->skip;
    }

    function getTake(): int
    {
        return $this->take;
    }

    function getIds(): array
    {
        return $this->ids;
    }

    function getQuery(): Builder
    {
        $query = User::query();

        switch ($this->customQuery) {
            case "hasOldActiveSubscription":
                $query = $query->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('ecommerce_subscriptions')
                        ->whereRaw('ecommerce_subscriptions.user_id = usora_users.id')
                        ->where('ecommerce_subscriptions.is_active', '1')
                        ->where('ecommerce_subscriptions.paid_until', '>', '2023-12-07');
                });
                break;
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
            case "hasMigrationDays":
                $query = $query->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('user_access_permissions')
                        ->whereRaw('user_access_permissions.user_id = usora_users.id')
                        ->whereNull('user_access_permissions.time_fixed')
                        ->where('user_access_permissions.source', 'migration')
                        ->where('user_access_permissions.time_lifetime', false);
                });
                break;
            case "createdWithinLastDay":
                $query = $query->where('created_at', '>', Carbon::now()->subDay());
                break;
            case "isAdmin":
                $query = $query->where('permission_level', User::PERMISSION_LEVEL_ADMIN);
                break;
            case "requiresRechargeSync":
                $query = $query->whereRaw(
                    'recharge_renewal_date is not null and recharge_renewal_date > now() and DATEDIFF(membership_expiration_date, recharge_renewal_date) - 7 > 7'
                );
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
