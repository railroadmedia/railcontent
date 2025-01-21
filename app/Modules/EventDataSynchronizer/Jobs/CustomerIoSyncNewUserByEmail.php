<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use App\Modules\EventTracking\Services\CustomerIoService as EventTrackingCustomerIoService;
use App\Modules\UserManagementSystem\Services\UserService;
use Exception;
use Modules\UserManagementSystem\Models\User;
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
     * @throws Throwable
     */
    public function handle(
        CustomerIoService $customerIoService,
        CustomerIoSyncService $customerIoSyncService,
        UserService $userService,
        EventTrackingCustomerIoService $eventTrackingCustomerIoService,
        UserAccessPermissionsService $userAccessPermissionsService
    ): void {
        try {
            $this->user = $userService->GetByIdOrNull($this->user->id);
            $accountNameBrandsToSync = config('event-data-synchronizer.customer_io_account_name_brands_to_sync', []);
            $accountNameToSyncAllBrand = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');
            $accountCreatedAt = $this->user->created_at->timestamp;

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
                        $this->user->id,
                        $accountCreatedAt
                    );
                }
            }

            /*
             * @TODO EVENT TRACKING: move this to the new event tracking when migration is completed
             */
            $eventTrackingCustomerIoService->updateUserAttributes(
                $this->user,
                ['account_created_at' => $accountCreatedAt]
            );
        } catch (Exception $exception) {
            $this->failed($exception);
        }
    }

    /**
     * The job failed to process.
     */
    public function failed(Throwable $exception): void
    {
        \Log::error('CustomerIoSyncNewUserByEmail job failed for user: ' . $this->user->id);

        parent::failed($exception);
    }
}
