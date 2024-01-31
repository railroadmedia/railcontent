<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventTracking\Jobs\SyncUserCustomerIoAttributesJob;

class SyncUserCustomerIoAttributes extends Command
{
    protected $signature = 'eventTracking:syncUserCustomerIoAttributes {workspaceName} {--fromPermissions}';
    protected $description = 'Sync users that have digital product access to customerio';

    public function handle(): void
    {
        $workspaceName = $this->argument('workspaceName');
        $fromPermissions = $this->option('fromPermissions');
        $this->runBatchQuery(
            function (int $skip, int $take) use ($workspaceName, $fromPermissions) {
                return new SyncUserCustomerIoAttributesJob(
                    $skip,
                    $take,
                    $workspaceName,
                    $fromPermissions
                );
            },
            chunks: 100,
            queue: 'command'
        );
    }
}
