<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use Exception;
use Railroad\CustomerIo\Services\CustomerIoService;

class CustomerIoSyncMentor extends CustomerIoBaseJob
{

    private int $userId;
    private int $mentorUserId;

    public function __construct(int $userId, int $mentorUserId)
    {
        $this->userId = $userId;
        $this->mentorUserId = $mentorUserId;
    }

    /**
     * @param CustomerIoService $customerIoService
     * @throws \Throwable
     */
    public function handle(
        CustomerIoService $customerIoService,
        CustomerIoSyncService $customerIoSyncService,
    ) {
        try {
            $accountName = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');
            $attributes = $customerIoSyncService->getMentorAttributes($this->mentorUserId);

            $customerIoService->createOrUpdateCustomerByUserId($this->userId, $accountName, null, $attributes);
        } catch (Exception $exception) {
            $this->failed($exception);
        }
    }
}
