<?php

namespace Modules\Ecommerce\Jobs\Shopify;

use App\Jobs\WebhookJob;
use App\Modules\Ecommerce\Jobs\AssignPrimaryBrandJob;
use App\Modules\Ecommerce\Jobs\Shopify\AddOrderTags;
use App\Modules\Ecommerce\Jobs\Shopify\OrderCreatedEventTrackingJob;
use App\Modules\Ecommerce\Jobs\Shopify\OrderCreatedSubscriptionManagerJob;
use App\Modules\Ecommerce\Jobs\Shopify\OrderCreatedUpdateLastTrialDataJob;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;

class ShopifyOrderCreatedJob
{
    public function __construct(
        private $id,
        private $contents,
    ) {
    }

    public function handle(): void
    {
        $children = [
            new AddOrderTags(new Order(json_decode(json_encode($this->contents), false))),
            new OrderCreatedEventTrackingJob($this->contents),
            new OrderCreatedUpdateLastTrialDataJob($this->contents),
            new OrderCreatedSubscriptionManagerJob($this->contents),
            new AssignPrimaryBrandJob($this->contents),
        ];
        dispatch(new WebhookJob('Shopify-order-created', $this->id, $this->contents, $children));
    }
}
