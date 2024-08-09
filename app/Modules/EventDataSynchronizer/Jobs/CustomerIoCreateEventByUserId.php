<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\UserManagementSystem\Services\UserService;
use Exception;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Throwable;

class CustomerIoCreateEventByUserId extends CustomerIoBaseJob
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var string
     */
    private $accountName;

    /**
     * @var string
     */
    private $eventName;

    /**
     * @var array
     */
    private $eventData;

    /**
     * @var string|null
     */
    private $eventType;

    /**
     * @var int|null
     */
    private $eventTimestamp;

    public $tries = 3;

    /**
     * CustomerIoCreateEventByUserId constructor.
     */
    public function __construct(
        int $userId,
        string $accountName,
        string $eventName,
        array $eventData = [],
        ?string $eventType = null,
        ?int $eventTimestamp = null
    ) {
        $this->userId = $userId;
        $this->accountName = $accountName;
        $this->eventName = $eventName;
        $this->eventData = $eventData;
        $this->eventType = $eventType;
        $this->eventTimestamp = $eventTimestamp;
    }

    /**
     * @throws \Throwable
     */
    public function handle(
        CustomerIoService $customerIoService,
        UserService $userService
    ) {
        try {
            $user = $userService->GetByIdOrNull($this->userId);

            $accountNameToSyncAllBrand = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');

            try {
                $existingSpecificBrandCustomer = $customerIoService->getCustomerByUserId(
                    $this->accountName,
                    $user->id,
                );
                $existingAllBrandCustomer = $customerIoService->getCustomerByUserId(
                    $accountNameToSyncAllBrand,
                    $user->id,
                );
            } catch (Throwable $exception) {
                if (empty($existingSpecificBrandCustomer) || empty($existingAllBrandCustomer)) {
                    dispatch_sync(new CustomerIoSyncNewUserByEmail($user));

                    sleep(5);

                    $user = $userService->GetByIdOrNull($this->userId);
                }
            }

            // events always sync to the brand specific workspace and the primary all synced workspace
            if ($this->accountName !== $accountNameToSyncAllBrand && $this->accountName !== 'musora_prospects') {
                $customerIoService->createEventForUserId(
                    $user->id,
                    $accountNameToSyncAllBrand,
                    $this->eventName,
                    $this->eventData,
                    $this->eventType,
                    $this->eventTimestamp
                );
            }

            try {
                $customerIoService->createEventForUserId(
                    $user->id,
                    $this->accountName,
                    $this->eventName,
                    $this->eventData,
                    $this->eventType,
                    $this->eventTimestamp
                );
            } catch (Throwable $exception) {
                if (str_contains(
                    $exception->getMessage(),
                    'Customer not found'
                )) {
                    //Log::warning("User $user->id does not exist in the customer io $this->accountName workspace");
                } else {
                    throw $exception;
                }
            }
        } catch (Exception $exception) {
            $this->failed($exception);
        }
    }

    /**
     * The job failed to process.
     *
     * @param $user
     */
    public function failed(Throwable $exception)
    {
        error_log(
            'Error on CustomerIoCreateEventByUserId job trying to sync user to customer.io. User ID: ' .
                $this->userId
        );

        error_log($exception);

        parent::failed($exception);
    }
}
