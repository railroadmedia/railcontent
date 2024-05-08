<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\UserManagementSystem\Services\UserService;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railroad\Ecommerce\Entities\User as EcommerceUser;
use Railroad\Ecommerce\Services\UserProductService;
use Modules\UserManagementSystem\Models\User;

class CustomerIoDeleteUser implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function handle(
        CustomerIoService $customerIoService,
        UserService $userService,
        UserProductService $userProductService
    ) {
        /** @var User $user */
        $user = $userService->getByIdOrNull($this->userId);
        $accountNameBrandsToSync = config('event-data-synchronizer.customer_io_account_name_brands_to_sync', []);
        $accountNameToSyncAllBrand = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');

        foreach ($accountNameBrandsToSync as $accountName => $brands) {
            // in order for this user to be synced to a specific workspace, they must have at least 1 product
            // from any of the brands which are configured to be synced to the workspace.
            $syncThisWorkspace = false;

            foreach ($brands as $brand) {
                if ($userProductService->userHadOrHasAnyDigitalProductsForBrand(
                    new EcommerceUser($user->id, $user->email),
                    $brand
                ) || $accountNameToSyncAllBrand == $brand) {
                    $syncThisWorkspace = true;
                }
            }

            if ($syncThisWorkspace) {
                $customerIoService->deleteCustomer($user->id, $accountName);
            }
        }
    }
}
