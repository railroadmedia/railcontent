<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;

class OrderCreatedUpdateLastTrialDataJob extends WebhookChildJob
{
    public function __construct(
        private $contents,
    ) {
    }

    public function handle(ProductService $productService, ShopifyGateway $shopifyGateway, UserService $userService)
    {
        $lineItems = $this->contents['line_items'];
        $shopifyCustomerId = $this->contents['customer']['id'];
        foreach ($lineItems as $lineItem) {
            $sku = $lineItem['sku'];
            if (Product::IsTrialSku($sku)) {
                $trialProduct = $productService->getProductsBySkus([$sku])[0];
                $now = Carbon::now('UTC');
                $lastTrialEndDate = $now->addDays($trialProduct->getTrialDays());
                $shopifyGateway->updateCustomerLastTrialEndDate($shopifyCustomerId, $lastTrialEndDate);
                $userService->setTrialPeriod($shopifyCustomerId, $lastTrialEndDate);
                break;
            }
        }
    }
}
