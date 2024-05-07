<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventTracking\Jobs\SyncUserPaymentMethodsToCioJob;

class SyncUserPaymentMethodsToCio extends Command
{
    protected $signature = 'eventTracking:syncUserPaymentMethodsToCio {workspaceName}';
    protected $description = 'Sync user\'s payment method data to customerio';

    public function handle(): void
    {
        $workspaceName = $this->argument('workspaceName');
        $this->runBatchQuery(
            function (int $skip, int $take) use ($workspaceName) {
                return new SyncUserPaymentMethodsToCioJob(
                    $skip,
                    $take,
                    $workspaceName,
                );
            },
            chunks: 100,
            queue: 'command'
        );
    }
}
