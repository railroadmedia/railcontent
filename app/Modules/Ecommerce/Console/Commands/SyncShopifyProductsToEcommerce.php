<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\SyncShopifyProductToEcommerce;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\Shopify;
use Throwable;

class SyncShopifyProductsToEcommerce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-products-to-ecommerce
                            {--shopifyProductTitle= : (Optional) The Shopify title of the product to sync down all variants for}
                            {--ecommerceId= : (Optional) The ID of the ecommerce product to find in Shopify and sync down.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Shopify products down to the ecommerce_products table';

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

        $shopifyProductTitle = $this->option("shopifyProductTitle");
        $ecommerceId = $this->option("ecommerceId");

        $query = [];
        if ($shopifyProductTitle) {
            $query = ['title' => $shopifyProductTitle];
        } elseif ($ecommerceId) {
            $ecommerceProduct = Product::find($ecommerceId);
            $query = ['title' => $ecommerceProduct->name];
        }

        $fields = array_merge(['limit' => 100], $query);
        $pages = $shopify->paginateProducts($fields);

        $products = collect();
        /** @var Collection<ApiResource> $pages */
        foreach ($pages as $page) {
            $products = $products->merge($page->map(fn (ApiResource $page) => $page->getAttributes()));
        }

        if ($products->isEmpty()) {
            $this->error(sprintf(
                'No products found in Shopify %s',
                $query ? ' for ' . implode(', ', array_map(
                    fn ($key, $value) => "$key: $value",
                    array_keys($query),
                    $query
                )) : ''
            ));
            return self::FAILURE;
        }

        $jobs = [];
        $products->each(function ($shopifyProduct) use (&$jobs) {
            $jobs[] = new SyncShopifyProductToEcommerce($shopifyProduct);
        });

        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("SyncShopifyProductsToEcommerce: completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();

        $this->info(
            sprintf(
                "SyncShopifyProductsToEcommerce: Batch ID %s dispatched with %s %s to sync %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
                $products->count(),
                Str::plural("product", $products->count())
            )
        );

        return self::SUCCESS;
    }
}
