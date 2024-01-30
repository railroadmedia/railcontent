<?php

namespace App\Modules\EventTracking\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\CustomerIO\Models\Customer;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class SyncUserCustomerIoAttributesJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    protected array $ids;
    private string $workspaceName;
    private string $fromPermissions;
    private CustomerIoService $customerIoService;
    private ShopifySyncService $shopifySyncService;

    public function __construct(int $skip, int $take, string $workspaceName, bool $fromPermissions)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->workspaceName = $workspaceName;
        $this->fromPermissions = $fromPermissions;
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
        if ($this->fromPermissions) {
            return UserAccessPermission::query()
                ->join('usora_users', 'usora_users.id', '=', 'user_access_permissions.user_id')
                ->join(
                    'railcontent_permissions',
                    'railcontent_permissions.id',
                    '=',
                    'user_access_permissions.permission_id'
                )
                ->where([
                    'status' => 'active',
                    'railcontent_permissions.brand' => $this->workspaceName,
                ])
                ->where('usora_users.membership_expiration_date', '>', now())
                ->selectRaw('DISTINCT user_access_permissions.user_id');
        } else {
            $this->customerIoService = app(CustomerIoService::class);
            $accountConfigData = $this->customerIoService->getAccountConfigData($this->workspaceName);

            return Customer::query()
                ->whereNotNull('user_id')
                ->where(
                    [
                        'workspace_id' => $accountConfigData['workspace_id'],
                        'site_id' => $accountConfigData['site_id'],
                        'workspace_name' => $this->workspaceName,
                    ]
                );
        }
    }

    public function handleItem($item): void
    {
        try {
            /** @var Customer $item */
            /** @var User $user */
            $user = User::find($item->user_id);
            if ($user && $user->shopify_id) {
                $this->shopifySyncService->syncCustomer($user->shopify_id, $user->email);
            }
        } catch (Throwable $ex) {
            Log::error("Error migrating profile for email $item->email");
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
