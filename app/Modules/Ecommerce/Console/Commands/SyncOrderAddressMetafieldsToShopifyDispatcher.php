<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldOwnerTypeEnum;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\CreateMissingMetafieldDefinition;
use App\Modules\Ecommerce\Jobs\Shopify\SyncOrderAddressMetafieldsToShopify;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\Shopify\MetaFieldDefinition;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class SyncOrderAddressMetafieldsToShopifyDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-order-address-metafields
                            {--startCreatedAt= : (Optional) The ISO 8601 date time for all orders to get where created_at at or after. e.g. 2023-10-13T17:00:25+00:00}
                            {--endCreatedAt= : (Optional) The ISO 8601 date time for all orders to get where created_at at or before. e.g. 2023-10-13T17:30:14+00:00}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync the Country and Region metafields for orders in Shopify';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Throwable
     */
    public function handle(): int
    {
        $simulate = $this->option("execute") == false;
        $startCreatedAt = $this->option("startCreatedAt") ?: '1970-01-01T00:00:00Z';
        $endCreatedAt = $this->option("endCreatedAt") ?: config('ecommerce.launch_date_times.shopify');

        // find all orders that need to be synced
        $orders = Order::query()
            ->whereBetween('created_at', [$startCreatedAt, $endCreatedAt])
            ->whereNotNull('shopify_id')
            ->select("id");
        $orderCount = $orders->count();
        $batchSize = 500;

        // first, add the jobs to ensure the metafields exist in Shopify
        $jobs = [
            new CreateMissingMetafieldDefinition(
                new MetaFieldDefinition(
                    "Region",
                    null,
                    ShopifyMetafieldKey::AddressRegion,
                    ShopifyMetafieldTypes::single_line_text_field,
                    ShopifyMetafieldNamespace::Model_Orders,
                    ShopifyMetafieldOwnerTypeEnum::Order
                ),
                $simulate
            ),
            new CreateMissingMetafieldDefinition(
                new MetaFieldDefinition(
                    "Country",
                    null,
                    ShopifyMetafieldKey::AddressCountry,
                    ShopifyMetafieldTypes::single_line_text_field,
                    ShopifyMetafieldNamespace::Model_Orders,
                    ShopifyMetafieldOwnerTypeEnum::Order
                ),
                $simulate
            )
        ];

        $this->info(
            "SyncOrderAddressMetafieldsToShopify: Preparing to chunk orders into jobs for SyncOrderAddressMetafieldsToShopifyJobManager. Please wait..."
        );
        $startAt = Carbon::now();

        // step through the chunks of order ids to sync, and add a job to process each chunk
        $orders->chunkById($batchSize, function ($orderIds) use ($simulate, &$jobs) {
            $firstOrderId = $orderIds->first()->id;
            $lastOrderId = $orderIds->last()->id;
            $jobs[] = new SyncOrderAddressMetafieldsToShopify(
                $firstOrderId,
                $lastOrderId,
                $simulate
            );
        });
        $this->info(
            sprintf(
                "SyncOrderAddressMetafieldsToShopify: Completed dispatching jobs in %s seconds.",
                $startAt->diffInSeconds()
            )
        );

        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(
                    sprintf("SyncOrderAddressMetafieldsToShopify: Completed in %s seconds", $startAt->diffInSeconds())
                );
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();
        $this->info(
            sprintf(
                "SyncOrderAddressMetafieldsToShopify: Batch ID %s dispatched with %s %s to sync %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
                $orderCount,
                Str::plural("order", $orderCount)
            )
        );

        return self::SUCCESS;
    }
}
