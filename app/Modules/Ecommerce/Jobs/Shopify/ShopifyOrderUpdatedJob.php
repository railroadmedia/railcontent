<?php

namespace Modules\Ecommerce\Jobs\Shopify;

use App\Jobs\WebhookJob;
use App\Modules\Ecommerce\Jobs\ShopifySyncCustomerJob;

class ShopifyOrderUpdatedJob
{
    public function __construct(
        private $id,
        private $contents,
        private $shopifyCustomerId,
        private $email
    ) {
    }

    public function handle(): void
    {
        $children = [
            new ShopifySyncCustomerJob($this->shopifyCustomerId, $this->email),
            new OrderUpdateChallengesEnrollment($this->contents),
        ];
        dispatch(new WebhookJob('Shopify-order-updated', $this->id, $this->contents, $children));
    }
}
