<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Services\ShopifySyncProductService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Signifly\Shopify\Shopify;

class SyncShopifyProductToEcommerce implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Shopify $shopify;
    public int $tries = 2;
    public int $timeout = 840;

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    private array $data;

    public function __construct(
        array $data
    ) {
        $this->data = $data;
    }

    public function handle(ShopifySyncProductService $shopifySyncProductService): void
    {
        $shopifySyncProductService->sync($this->data);
    }
}
