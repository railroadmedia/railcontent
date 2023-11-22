<?php

namespace App\Console\Commands;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifyAPIService;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class SyncShopifyProductInventoryToProductsTable extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'SyncShopifyProductInventoryToProductsTable';

    protected $signature = 'SyncShopifyProductInventoryToProductsTable';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ShopifyAPIService $shopifyAPIService,)
    {
        $this->info('Starting SyncShopifyProductInventoryToProductsTable.');

        Product::query()
            ->orderBy('id', 'desc')
            ->chunk(20, function (Collection $products) use ($shopifyAPIService) {
                $skuInventoryCounts = $shopifyAPIService->getProductInventoryCountFromSKUs(
                    $products->pluck('sku')->toArray()
                );

                /**
                 * @var $products Product[]
                 */
                foreach ($products as $product) {
                    if (isset($skuInventoryCounts[$product->sku]) && $product->stock !== $skuInventoryCounts[$product->sku]) {
                        $this->info(
                            'Setting product SKU ' . $product->sku . ' inventory count from: ' . $product->stock . ' to: ' . $skuInventoryCounts[$product->sku]
                        );
                        $product->stock = $skuInventoryCounts[$product->sku];

                        // shopify already calculates this on their end so min stock level should always be 0 or null
                        if ($product->min_stock_level !== null) {
                            $product->min_stock_level = 0;
                        }

                        $product->save();
                    }
                }

                // we don't want to hit the API limit
                sleep (2);
            });

        $this->info('---------------------------------------------------');
        $this->info('Finished SyncShopifyProductInventoryToProductsTable!');

        return true;
    }
}
