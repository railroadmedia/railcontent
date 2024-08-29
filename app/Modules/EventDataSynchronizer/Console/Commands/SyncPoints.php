<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\SyncPointsJob;

class SyncPoints extends Command
{
    protected $signature = 'points:sync';

    public function handle(): void
    {
        $this->runChainQuery(function (int $skip, int $take) {
            return new SyncPointsJob($skip, $take);
        }, chunks: 2000);
    }
}
