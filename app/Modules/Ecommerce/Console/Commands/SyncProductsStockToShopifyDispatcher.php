<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\SyncProductsStockToShopify;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\Shopify;
use Throwable;

class SyncProductsStockToShopifyDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-products-stock
                            {--fake : Fake the product\'s stock. Otherwise, sync the correct stock. }
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync stock for our products up to Shopify. With the fake option enabled,' .
        ' the stock will be set to a fake value so that our historical orders can be accepted in Shopify.';

    /**
     * Execute the console command.
     *
     * @param  Shopify  $shopify
     * @return int
     * @throws Throwable
     */
    public function handle(
        Shopify $shopify,
    ): int {
        // first ensure there is a location set up with Shopify, so we don't attempt anything else in case there isn't
        // we only set up the one location, so just grab that first result
        /** @var ApiResource $location */
        $location = $shopify->getLocations()?->first() ?: null;
        if (empty($location)) {
            throw new Exception("No location found! Please set up a location inside the Shopify store to proceed.");
        }
        $locationId = $location->getAttributes()["id"];

        $fake = $this->option("fake");
        $simulate = $this->option("execute") == false;

        // find all products that need to be synced
        $products = Product::query()
            ->whereNotNull("shopify_id")
            ->select("id");

        $productCount = $products->count();
        $batchSize = 25;
        $jobs = [];

        // step through the chunks of product ids to sync, and add a job to process each chunk
        $products->chunk($batchSize, function ($productIds) use ($locationId, $simulate, $fake, &$jobs) {
            $firstProductId = $productIds->first()->id;
            $lastProductId = $productIds->last()->id;
            $jobs[] = new SyncProductsStockToShopify($firstProductId, $lastProductId, $fake, $locationId, $simulate);
        });

        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("SyncProductsStockToShopifyDispatcher: completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();
        $this->info(
            sprintf(
                "SyncProductsStockToShopifyDispatcher: Batch ID %s dispatched with %s %s to %s %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
                $fake ? "fake" : "set",
                $productCount,
                Str::plural("product", $productCount)
            )
        );

        return self::SUCCESS;
    }
}
