<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\ShopifyCustomersSyncAllJob;

class ShopifyCustomerSyncAll extends Command
{
    protected $signature = 'ecommerce:ShopifyCustomerSyncAll {startId?} {endId?}';

    public function handle()
    {
        $startId = $this->argument('startId') ?? null;
        $endId = $this->argument('endId') ?? null;
        $this->runBatchQuery(function (int $skip, int $take) use ($startId, $endId) {
            return new ShopifyCustomersSyncAllJob($skip, $take, $startId, $endId);
        }, chunks: 100, queue: 'command');
    }
}
