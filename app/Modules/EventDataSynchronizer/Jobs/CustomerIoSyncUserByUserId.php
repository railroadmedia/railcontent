<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\UserManagementSystem\Services\UserService;
use Exception;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Railroad\Ecommerce\Entities\User as EcommerceUser;
use Railroad\Ecommerce\Services\UserProductService;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class CustomerIoSyncUserByUserId extends CustomerIoBaseJob
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param  CustomerIoService  $customerIoService
     * @throws \Throwable
     */
    public function handle(
        CustomerIoService $customerIoService,
        CustomerIoSyncService $customerIoSyncService,
        UserService $userService,
        UserProductService $userProductService
    ) {
        try {
            $this->user = $userService->getByIdOrNull($this->user->id);
            $accountNameBrandsToSync = config('event-data-synchronizer.customer_io_account_name_brands_to_sync', []);
            $accountNameToSyncAllBrand = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');

            foreach ($accountNameBrandsToSync as $accountName => $brands) {
                // in order for this user to be synced to a specific workspace, they must have at least 1 product
                // from any of the brands which are configured to be synced to the workspace.
                $syncThisWorkspace = false;

                foreach ($brands as $brand) {
                    if ($userProductService->userHadOrHasAnyDigitalProductsForBrand(
                            new EcommerceUser($this->user->id, $this->user->email),
                            $brand
                        ) || $accountNameToSyncAllBrand == $brand) {
                        $syncThisWorkspace = true;
                    }
                }

                if ($syncThisWorkspace) {
                    $customerAttributes = $customerIoSyncService->getUsersCustomAttributes($this->user, $brands);

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
     * @param  Throwable  $exception
     */
    public function failed(Throwable $exception)
    {
        error_log(
            'Error on CustomerIoSyncUserById job trying to sync user to customer.io. User ID: '.
            $this->user->id.' - lookupEmail: '.$this->user->email
        );

        error_log($exception);

        parent::failed($exception);
    }
}
