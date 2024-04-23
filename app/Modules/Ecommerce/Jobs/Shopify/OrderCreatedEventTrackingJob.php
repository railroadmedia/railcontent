<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Services\EventTrackingService;

class OrderCreatedEventTrackingJob extends WebhookChildJob
{
    public function __construct(
        private $contents,
    ) {}

    public function handle(EventTrackingService $eventTrackingService): void
    {
        $eventTrackingService->handleOrderCreatedEventTracking($this->contents);
    }
}
