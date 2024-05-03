<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Models\Product;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Signifly\Shopify\Exceptions\NotFoundException;
use Signifly\Shopify\Shopify;

class SyncProductsStockToShopify implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use HandlesShopifyRateLimit;
    use LogsShopify;
    use Queueable;
    use SerializesModels;

    private const FAKE_STOCK_COUNT = 999999;
    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;
    protected Shopify $shopify;

    public function __construct(
        protected int $startAtId,
        protected int $endAtId,
        protected bool $fake,
        protected int $locationId,
        protected bool $simulate
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     *
     * @param  Shopify  $shopify
     * @return void
     * @throws Exception
     */
    public function handle(
        Shopify $shopify
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;

        $this->logDebug(
            sprintf("%s: running batch for products %s - %s", $this->getClassName(), $this->startAtId, $this->endAtId)
        );

        $batchSize = 25;

        Product::query()
            ->whereBetween("id", [$this->startAtId, $this->endAtId])
            ->whereNotNull("shopify_id")
            ->chunk($batchSize, function (Collection $productsChunk) {
                $productsChunk->each(function (Product $product) {
                    $desiredStock = $this->fake ? self::FAKE_STOCK_COUNT : $product->getStockAvailability();
                    // initial value, for simulation
                    $stockAdjustment = $this->fake ? self::FAKE_STOCK_COUNT : $product->getStockAvailability();

                    if (!$this->simulate) {
                        try {
                            $variantResource = $this->shopify->getVariant($product->shopify_id);
                            $this->handleRateLimit();
                        } catch (NotFoundException $exception) {
                            $this->logError(
                                sprintf(
                                    "%s: No product variant found for Shopify ID %s. Product %s"
                                    ." could not have inventory levels adjusted",
                                    $this->getClassName(),
                                    $product->shopify_id,
                                    $product->id
                                )
                            );
                            $this->handleRateLimit();
                            return;
                        }
                        $variantAttributes = $variantResource->getAttributes();
                        $inventoryQuantity = $variantAttributes["inventory_quantity"];
                        $stockAdjustment = $desiredStock - $inventoryQuantity;

                        $this->shopify->adjustInventoryLevel(
                            $variantAttributes["inventory_item_id"],
                            $this->locationId,
                            $stockAdjustment
                        );

                        $this->handleRateLimit();
                    }

                    $this->logInfo(
                        sprintf(
                            "%s: Product ID %s - %s (Shopify Variant ID %s): Inventory adjustment %s by %s",
                            $this->getClassName(),
                            $product->id,
                            $product->sku,
                            $product->shopify_id,
                            $this->fake ? "faked" : "set",
                            $stockAdjustment
                        )
                    );
                });
            });
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncProductsStockToShopify";
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->simulate;
    }
}
