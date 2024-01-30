<?php

namespace App\Modules\EventTracking\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\CustomerIO\Models\Customer;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class SyncUserWithPermissionsToCustomerIoJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    protected array $ids;
    private string $workspaceName;
    private ShopifySyncService $shopifySyncService;

    public function __construct(int $skip, int $take, string $workspaceName)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->workspaceName = $workspaceName;
    }

    public function getSkip(): int
    {
        return $this->skip;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    /**
     * @throws Exception
     */
    public function getQuery(): Builder
    {
        return UserAccessPermission::query()
            ->join('usora_users', 'usora_users.id', '=', 'user_access_permissions.user_id')
            ->join(
                'railcontent_permissions',
                'railcontent_permissions.id',
                '=',
                'user_access_permissions.permission_id'
            )
            ->where(['status' => 'active', 'railcontent_permissions.brand' => $this->workspaceName,])
            ->where('usora_users.membership_expiration_date', '>', now())
            ->selectRaw('DISTINCT user_access_permissions.user_id');
    }

    public function handleItem($item): void
    {
        try {
            /** @var UserAccessPermission $item */
            /** @var User $user */
            $user = $item->user();
            if ($user->shopify_id) {
                $this->shopifySyncService->syncCustomer($user->shopify_id, $user->email);
            }
        } catch (Throwable $ex) {
            Log::error("Error migrating profile for email $item->user_id");
            Log::error($ex);
        }
    }

    public function handleAllItems($items): bool
    {
        $this->shopifySyncService = app(ShopifySyncService::class);
        foreach ($items as $item) {
            $this->handleItem($item);
        }
        return true;
    }
}
