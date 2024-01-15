<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use App\Modules\UserManagementSystem\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class CustomerIoSyncUserByUserId extends CustomerIoBaseJob
{
    /**
     * @var User
     */
    private $user;
    private array $data;

    public function __construct(User $user, array $data = [])
    {
        $this->user = $user;
        $this->data = $data;
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
        UserAccessPermissionsService $userAccessPermissionsService,
    ): void {
        try {
            $this->user = $userService->getByIdOrNull($this->user->id);
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
                        break;
                    }
                }

                if ($syncThisWorkspace) {
                    $customerAttributes = $customerIoSyncService->getUsersCustomAttributes($this->user, $brands);
                    if ($this->data) {
                        $customerAttributes = array_merge($customerAttributes, $this->data);
                    }

                    $customerIoService->createOrUpdateCustomerByUserId(
                        $this->user->id,
                        $accountName,
                        $this->user->email,
                        $customerAttributes,
                        $this->user->created_at->timestamp
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
        Log::error('CustomerIoSyncUserByUserId job failed for user: ' . $this->user->id);
        parent::failed($exception);
    }
}
