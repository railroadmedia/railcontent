<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\ShopifyCustomersSyncAllJob;

class ShopifyCustomerSyncAll extends Command
{
    protected $signature = 'ecommerce:ShopifyCustomerSyncAll';

    public function handle()
    {
        $this->runChainQuery(function (int $skip, int $take) {
            return new ShopifyCustomersSyncAllJob($skip, $take);
        }, chunks: 100);
    }
}
