<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\ShopifyCustomersSyncAllJob;

class ShopifyCustomerSyncAll extends Command
{
    protected $signature = 'ecommerce:ShopifyCustomerSyncAll {startId} {endId}
    {--rebuildPermissions : removed existing shopify permissions before creating them}
    {--skipEventSync : only pull data into user access permissions table, nothing else}';
    protected $description = 'Sync shopfiy order data into user access permissions table';

    public function handle()
    {
        $startId = $this->argument('startId') ?? null;
        $endId = $this->argument('endId') ?? null;
        $isRebuildingPermissions = $this->option('rebuildPermissions');
        $syncEventSync = $this->option('skipEventSync');
        $this->runBatchQuery(
            function (int $skip, int $take) use ($isRebuildingPermissions, $syncEventSync, $startId, $endId) {
                return new ShopifyCustomersSyncAllJob(
                    $skip,
                    $take,
                    $startId,
                    $endId,
                    $isRebuildingPermissions,
                    $syncEventSync
                );
            },
            chunks: 100,
            queue: 'command'
        );
    }
}
