<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\ShopifyCustomersSyncAllJob;

class ShopifyCustomerSyncAll extends Command
{
    protected $signature = 'ecommerce:ShopifyCustomerSyncAll {startId} {endId}
    {--skipEventSync : only pull data into user access permissions table, nothing else}
    {--customQuery= : run a custom query instead of the default one, see QueryServices.getCustomUserQuery for options}
    {--customQueryParameter= : parameter for custom query}';

    protected $description = 'Sync shopfiy order data into user access permissions table';

    public function handle()
    {
        $startId = $this->argument('startId') ?? null;
        $endId = $this->argument('endId') ?? null;
        $customQuery = $this->option('customQuery');
        $customQueryParameter = $this->option('customQueryParameter');
        $syncEventSync = $this->option('skipEventSync');
        $this->runBatchQuery(
            function (int $skip, int $take) use ($customQueryParameter, $customQuery, $syncEventSync, $startId, $endId) {
                return new ShopifyCustomersSyncAllJob(
                    $skip,
                    $take,
                    $startId,
                    $endId,
                    $customQuery,
                    $customQueryParameter,
                    $syncEventSync
                );
            },
            chunks: 100,
            queue: 'command'
        );
    }
}
