<?php

namespace App\Modules\Ecommerce\Jobs;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Services\ShopifySyncProductService;
use App\Modules\Ecommerce\Services\ShopifySyncService;

class ShopifySyncProductJob extends WebhookChildJob
{
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
