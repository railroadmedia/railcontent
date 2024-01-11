<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventTracking\Jobs\MergeDBCustomerIoProfilesJob;

class MergeDBCustomerIoProfiles extends Command
{
    protected $signature = 'eventTracking:mergeDBCustomerIoProfiles {workspaceName}';

    protected $description = 'Merge duplicate customer.io profiles that exists in the customer_io_customers table';

    public function handle(): void
    {
        $workspaceName = $this->argument('workspaceName');

        $this->runBatchQuery(
            function (int $skip, int $take) use ($workspaceName) {
                return new MergeDBCustomerIoProfilesJob(
                    $skip,
                    $take,
                    $workspaceName
                );
            },
            chunks: 100,
            queue: 'command'
        );
    }
}
