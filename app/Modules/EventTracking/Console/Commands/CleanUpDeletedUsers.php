<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoDeleteUserFromMusoraWorkspace;
use Illuminate\Support\Carbon;

class CleanUpDeletedUsers extends Command
{
    protected $signature = 'eventTracking:cleanUpDeletedUsers';
    protected $description = 'Sync deleted users with CustomerIO.';

    public function handle(): void
    {
        $this->info('Starting command: ' . Carbon::now()->toDateTimeString());

        $this->runBatchQuery(
            function (int $skip, int $take) {
                return new CustomerIoDeleteUserFromMusoraWorkspace(
                    $skip,
                    $take,
                );
            },
            chunks: 100,
            queue: 'command'
        );

        $this->info('Finished command: ' . Carbon::now()->toDateTimeString());
    }
}
