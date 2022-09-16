<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\EventDataSynchronizer\Services\CustomerIoMentorSyncService;
use Exception;

class CustomerIoSyncMentor extends CustomerIoBaseJob
{

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout;

    private array $mentorStudentData;

    public function __construct(array $mentorStudentData)
    {
        //Set job timeout to 1 second per student since this could have thousands of students
        $this->timeout = count($mentorStudentData);
        $this->mentorStudentData = $mentorStudentData;
    }

    public function handle(
        CustomerIoService $customerIoService,
        CustomerIoMentorSyncService $customerIoMentorSyncService,
    ) {
        $i = 0;
        foreach($this->mentorStudentData as $mentorStudentDatum) {
            try {
                $accountName = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');
                $attributes = $customerIoMentorSyncService->getMentorAttributes(
                    $mentorStudentDatum['mentorUserId'],
                    $mentorStudentDatum['primaryBrand']
                );

                $customerIoService->createOrUpdateCustomerByUserId($mentorStudentDatum['userId'], $accountName, $mentorStudentDatum['email'], $attributes);
                usleep(100000); //precaution to keep customer.io limit under 100 requests per second
            } catch (Exception $exception) {
                $this->failed($exception);
            }
        }
    }
}
