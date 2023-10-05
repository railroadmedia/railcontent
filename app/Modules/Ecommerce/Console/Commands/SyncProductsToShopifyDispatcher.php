<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Models\ShopifySync;
use App\Modules\Ecommerce\Jobs\Shopify\SyncProductsToShopify;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\Shopify;
use Throwable;

class SyncProductsToShopifyDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-products
                            {--limit= : (Optional) The number of products to limit this run to.}
                            {--fresh : Sync all products, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our products up to Shopify';

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
        /** @var ApiResource $location */
        $location = $shopify->getLocations()?->first() ?: null;
        if (empty($location)) {
            throw new Exception("No location found! Please set up a location inside the Shopify store to proceed.");
        }
        $locationId = $location->getAttributes()["id"];

        $simulate = $this->option("execute") == false;
        $fresh = $this->option("fresh");
        $limit = $this->option("limit");

        // find all products that need to be synced
        $products = Product::query()
            ->when(!$fresh, function (Builder $q) {
                return $q->whereNull("shopify_id")
                    ->orWhereDate("updated_at", ">", $this->getDateTimeOfLastSync());
            })
            ->select("id");

        $productCount = $products->count();
        $batchSize = 25;
        $jobs = [];

        if ($limit) {
            $productCount = min($limit, $productCount);
            // chunk doesn't use a limit set in the query, so we'll work around that by keeping track of the count internally
            $isAtLimit = false;
            $tally = 0;
            $products->chunk(
                $batchSize,
                function ($productIds) use (
                    $limit,
                    &$isAtLimit,
                    $batchSize,
                    $simulate,
                    $fresh,
                    $locationId,
                    &$jobs,
                    &$tally
                ) {
                    if ($isAtLimit) {
                        return false;
                    }

                    $tally += $batchSize;
                    $remaining = $limit - $tally;
                    if ($remaining <= 0) {
                        $isAtLimit = true;
                        $toGet = $tally + $remaining;
                        $productIds = $productIds->take($toGet);
                    }

                    $firstProductId = $productIds->first()->id;
                    $lastProductId = $productIds->last()->id;
                    $jobs[] = new SyncProductsToShopify(
                        $firstProductId, $lastProductId, $locationId, $simulate, $fresh
                    );
                }
            );
        } else {
            // step through the chunks of product ids to sync, and add a job to process each chunk
            $products->chunk($batchSize, function ($productIds) use ($simulate, $fresh, $locationId, &$jobs) {
                $firstProductId = $productIds->first()->id;
                $lastProductId = $productIds->last()->id;
                $jobs[] = new SyncProductsToShopify($firstProductId, $lastProductId, $locationId, $simulate, $fresh);
            });
        }

        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("SyncProductsToShopify: completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->dispatch();
        $this->info(
            sprintf(
                "SyncProductsToShopify: Batch ID %s dispatched with %s %s to sync %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
                $productCount,
                Str::plural("product", $productCount)
            )
        );

        return self::SUCCESS;
    }

    /**
     * Get the date and time that products were last synced up to Shopify
     *
     * @return Carbon
     */
    protected function getDateTimeOfLastSync(): Carbon
    {
        $sync = ShopifySync::where("resource", ShopifySync::RESOURCE_PRODUCT)->latestFinished()->first();
        return $sync?->finished_at ?? Carbon::createFromTimestamp(0);
    }
}
