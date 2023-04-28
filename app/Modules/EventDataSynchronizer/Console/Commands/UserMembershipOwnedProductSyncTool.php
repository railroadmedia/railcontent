<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\UserMembershipOwnedProductSyncJob;

class UserMembershipOwnedProductSyncTool extends Command
{
    protected $name = 'UserMembershipOwnedProductSyncTool';
    protected $description = 'UserMembershipOwnedProductSyncTool';
    protected $signature = 'user:syncByOwner {productId} {syncCustomerIO?} {purchasedAfter?}';

    public function handle()
    {
        $productId = $this->argument('productId');
        $syncCustomerIO = $this->argument('syncCustomerIO') == 1;
        $purchasedAfter = $this->argument('purchasedAfter');

        $this->runChainQuery(function (int $skip, int $take) use ($productId, $syncCustomerIO, $purchasedAfter) {
            return new UserMembershipOwnedProductSyncJob($skip, $take, $productId, $syncCustomerIO, $purchasedAfter);
        }, chunks: 2000);
    }
}
