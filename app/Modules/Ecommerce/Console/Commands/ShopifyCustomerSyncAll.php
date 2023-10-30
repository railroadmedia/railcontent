<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\ShopifyCustomersSyncAllJob;

class ShopifyCustomerSyncAll extends Command
{
    protected $signature = 'ecommerce:ShopifyCustomerSyncAll {chunkSize=1000}';

    public function handle()
    {
        $chunkSize = $this->argument('chunkSize');
        $this->runBatchQuery(function (int $skip, int $take) {
            return new ShopifyCustomersSyncAllJob($skip, $take);
        }, chunks: $chunkSize, queue: 'command');
    }
}
