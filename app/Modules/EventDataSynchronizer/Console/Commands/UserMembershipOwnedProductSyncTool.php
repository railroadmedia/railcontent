<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\UserMembershipOwnedProductSyncJob;

class UserMembershipOwnedProductSyncTool extends Command
{
    protected $name = 'UserMembershipOwnedProductSyncTool';
    protected $description = 'UserMembershipOwnedProductSyncTool';
    protected $signature = 'user:syncByOwner {productId} {purchasedAfter?}';

    public function handle()
    {
        $productId = $this->argument('productId');
        $purchasedAfter = $this->argument('purchasedAfter');

        $this->runChainQuery(function (int $skip, int $take) use ($productId, $purchasedAfter) {
            return new UserMembershipOwnedProductSyncJob($skip, $take, $productId, $purchasedAfter);
        }, chunks: 2000);
    }
}
