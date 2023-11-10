<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Exception;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use Modules\UserManagementSystem\Models\User;
use App\Modules\UserManagementSystem\Services\UserService;
use Throwable;

class CustomerIoSyncNewUserByEmail extends CustomerIoBaseJob
{
    /**
     * @var User
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param CustomerIoService $customerIoService
     * @param CustomerIoSyncService $customerIoSyncService
     * @param UserService $userService
     * @param UserAccessPermissionsService $userAccessPermissionsService
     * @throws Throwable
     */
    public function handle(
        CustomerIoService $customerIoService,
        CustomerIoSyncService $customerIoSyncService,
        UserService $userService,
        UserAccessPermissionsService $userAccessPermissionsService
    ) {
        try {
            $this->user = $userService->GetByIdOrNull($this->user->id);
            $accountNameBrandsToSync = config('event-data-synchronizer.customer_io_account_name_brands_to_sync', []);
            $accountNameToSyncAllBrand = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');

            foreach ($accountNameBrandsToSync as $accountName => $brands) {
                // in order for this user to be synced to a specific workspace, they must have at least 1 product
                // from any of the brands which are configured to be synced to the workspace.
                $syncThisWorkspace = false;

                foreach ($brands as $brand) {
                    if ($userAccessPermissionsService->shouldSyncCustomerIOWorkspace($this->user, $brand)
                        || $accountNameToSyncAllBrand == $brand) {
                        $syncThisWorkspace = true;
                    }
                }

                if ($syncThisWorkspace) {
                    $customerAttributes = $customerIoSyncService->getUsersCustomAttributes($this->user, $brands);

                    $customerIoService->createOrUpdateCustomerByEmail(
                        $this->user->email,
                        $accountName,
                        $customerAttributes,
                        $this->user->id
                    );
                }
            }
        } catch (Exception $exception) {
            $this->failed($exception);
        }
    }

    /**
     * The job failed to process.
     *
     * @param Throwable $exception
     */
    public function failed(Throwable $exception): void
    {
        \Log::error('CustomerIoSyncNewUserByEmail job failed for user: ' . $this->user->id);

        parent::failed($exception);
    }
}
