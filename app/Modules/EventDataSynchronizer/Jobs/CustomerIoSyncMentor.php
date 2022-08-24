<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\EventDataSynchronizer\Services\CustomerIoMentorSyncService;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use Exception;

class CustomerIoSyncMentor extends CustomerIoBaseJob
{

    private int $userId;
    private int $mentorUserId;
    private string $primaryBrand;

    public function __construct(int $userId, int $mentorUserId, string $primaryBrand)
    {
        $this->userId = $userId;
        $this->mentorUserId = $mentorUserId;
        $this->primaryBrand = $primaryBrand;
    }

    /**
     * @param CustomerIoService $customerIoService
     * @throws \Throwable
     */
    public function handle(
        CustomerIoService $customerIoService,
        CustomerIoMentorSyncService $customerIoMentorSyncService,
    ) {
        try {
            $accountName = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');
            $attributes = $customerIoMentorSyncService->getMentorAttributes($this->mentorUserId, $this->primaryBrand);

            $customerIoService->createOrUpdateCustomerByUserId($this->userId, $accountName, null, $attributes);
        } catch (Exception $exception) {
            $this->failed($exception);
        }
    }
}
