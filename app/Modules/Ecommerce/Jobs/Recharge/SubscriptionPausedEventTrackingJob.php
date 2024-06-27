<?php

namespace App\Modules\Ecommerce\Jobs\Recharge;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Recharge\Subscription;
use App\Modules\Ecommerce\Services\EventTrackingService;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class SubscriptionPausedEventTrackingJob extends WebhookChildJob
{
    public function __construct(private array $contents)
    {
    }

    public function handle(
        RechargeGateway $rechargeGateway,
        EventTrackingService $eventTrackingService
    ): void {
        $subscription = new Subscription(json_decode(json_encode($this->contents), associative: false));
        $customer = $rechargeGateway->getCustomerByRechargeId($subscription->customerId);
        $shopifyId = $customer->externalCustomerId->ecommerce;

        /** @var User $user */
        $user = User::query()->where('shopify_id', '=', $shopifyId)->first();
        if (!$user) {
            Log::debug("User not found for shopify_id: $shopifyId");
            return;
        }

        $product = Product::query()->where('sku', '=', $subscription->sku)->first();
        if (!$product) {
            Log::debug("Product not found for sku: " . $subscription->sku);
            return;
        }
        $subscription->setProduct($product);

        $eventTrackingService->handleSubscriptionPaused($subscription, $user);
    }
}
