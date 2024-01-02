<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventTracking\Jobs\MergeDBCustomerIoProfilesJob;

class MergeDBCustomerIoProfiles extends Command
{
    protected $signature = 'eventTracking:mergeDBCustomerIoProfiles';

    protected $description = 'Merge duplicate customer.io profiles that exists in the customer_io_customers table';
    private const WORKSPACE_NAMES = ['musora', 'drumeo', 'pianote', 'guitareo', 'singeo'];

    public function handle(): void
    {
        foreach (self::WORKSPACE_NAMES as $workspaceName) {
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
}
