<?php

namespace App\Modules\EventTracking\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\CustomerIO\Models\Customer;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class MergeDBCustomerIoProfilesJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    protected array $ids;
    private string $workspaceName;
    private CustomerIoService $customerIoService;

    public function __construct(int $skip, int $take, string $workspaceName)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->workspaceName = $workspaceName;
        $this->customerIoService = app(CustomerIoService::class);
        $this->shopifySyncService = app(ShopifySyncService::class);
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
        $accountConfigData = $this->customerIoService->getAccountConfigData($this->workspaceName);

        return Customer::query()
            ->selectRaw('email, count(*) as pcount')
            ->where(
                [
                    'workspace_id' => $accountConfigData['workspace_id'],
                    'site_id' => $accountConfigData['site_id'],
                    'workspace_name' => $this->workspaceName,
                ]
            )
            ->groupBy('email')
            ->having('pcount', '>', 1);
    }

    public function handleItem($item): void
    {
        try {
            $accountConfigData = $this->customerIoService->getAccountConfigData($this->workspaceName);

            /** @var Customer $item */
            $profiles = Customer::query()
                ->where('email', $item->email)
                ->where(
                    [
                        'workspace_id' => $accountConfigData['workspace_id'],
                        'site_id' => $accountConfigData['site_id'],
                        'workspace_name' => $this->workspaceName,
                    ]
                )
                ->orderByRaw('user_id desc, created_at asc, updated_at desc');

            $primary = $profiles->first();
            $profiles = $profiles->skip(1)->get();
            foreach ($profiles as $secondary) {
                $this->customerIoService->mergeCustomers($this->workspaceName, $primary->uuid, $secondary->uuid);
            }

            $user = User::query()->where('email', $item->email)->first();

            if ($user) {
                $primary->user_id = $user->id;
                $primary->save();

                $this->shopifySyncService->syncCustomerByUser($user, false, false);
            }
        } catch (Throwable $ex) {
            Log::error("Error migrating profile for email $item->email");
            Log::error($ex);
        }
    }

    public function handleAllItems($items): bool
    {
        foreach ($items as $item) {
            $this->handleItem($item);
        }
        return true;
    }
}
