<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\UserMembershipOwnedProductSyncJob;

class UserMembershipOwnedProductSyncTool extends Command
{
    protected $name = 'UserMembershipOwnedProductSyncTool';
    protected $description = 'UserMembershipOwnedProductSyncTool';
    protected $signature = 'user:syncByOwner {productId}';

    public function handle()
    {
        $productId = $this->argument('productId');

        $this->runChainQuery(function (int $skip, int $take) use ($productId) {
            return new UserMembershipOwnedProductSyncJob($skip, $take, $productId);
        }, chunks: 2000);
    }
}
