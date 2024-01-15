<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Modules\Ecommerce\Jobs\Shopify\SyncImportedOrderShopifyIds;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class SyncImportedOrderShopifyIdsDispatcher extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-order-shopifyid
                            {--limit= : (Optional) The number of orders to limit this run to}
                            {--execute : Update the database records. Without this flag, results will be simulated.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Shopify Order ID onto ecommerce_order shopify_id for all orders imported into Shopify.';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Throwable
     */
    public function handle(): int
    {
        $simulate = $this->option("execute") == false;
        $limit = $this->option("limit");

        $startAt = Carbon::now();
        $batch = Bus::batch(new SyncImportedOrderShopifyIds(null, $limit, $simulate))
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("SyncImportedOrderShopifyIds: completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();
        $this->info(
            sprintf(
                "SyncImportedOrderShopifyIds: Batch ID %s dispatched.",
                $batch->id
            )
        );

        return self::SUCCESS;
    }
}
