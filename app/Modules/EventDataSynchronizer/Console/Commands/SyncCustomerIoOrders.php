<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\SyncCustomerIoOrdersJob;

class SyncCustomerIoOrders extends Command
{
    protected $signature = 'customerio:syncOrders}';

    public function handle()
    {
        $this->runChainQuery(function (int $skip, int $take) {
            return new SyncCustomerIoOrdersJob($skip, $take);
        }, chunks: 1000);
    }
}
