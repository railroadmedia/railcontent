<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventTracking\Jobs\SyncUserCustomerIoAttributesJob;
use App\Modules\EventTracking\Jobs\SyncUserWithPermissionsToCustomerIoJob;

class SyncUserWithPermissionsToCustomerIo extends Command
{
    protected $signature = 'eventTracking:syncUserWithPermissionsToCustomerIo {workspaceName}';
    protected $description = 'Sync users that have permissions to digital product access to customerio';

    public function handle(): void
    {
        $workspaceName = $this->argument('workspaceName');
        $this->runBatchQuery(
            function (int $skip, int $take) use ($workspaceName) {
                return new SyncUserWithPermissionsToCustomerIoJob(
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
