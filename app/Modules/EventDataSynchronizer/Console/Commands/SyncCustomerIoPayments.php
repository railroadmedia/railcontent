<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\SyncCustomerIoPaymentsJob;

class SyncCustomerIoPayments extends Command
{
    protected $signature = 'customerio:syncPayments {purchasedAfter}';

    public function handle()
    {
        $purchasedAfter = $this->argument('purchasedAfter');

        $this->runChainQuery(function (int $skip, int $take) use ($purchasedAfter) {
            return new SyncCustomerIoPaymentsJob($skip, $take, $purchasedAfter);
        }, chunks: 1000);
    }
}
