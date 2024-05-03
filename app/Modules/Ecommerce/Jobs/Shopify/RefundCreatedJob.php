<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Services\EventTrackingService;
use App\Modules\Ecommerce\Services\ShopifySyncService;

class RefundCreatedJob extends WebhookChildJob
{
    public function __construct(
        private $orderId,
        private $contents
    ) {
    }

    public function handle(ShopifySyncService $shopifySyncService, EventTrackingService $eventTrackingService)
    {
        $order = $shopifySyncService->getOrder($this->orderId);
        $eventTrackingService->handleOrderRefundEventTracking($this->contents, $order->getAttributes());
    }
}
