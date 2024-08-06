<?php

namespace App\Modules\Ecommerce\Jobs\Recharge;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Services\EventTrackingService;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class PaymentMethodUpdatedEventTrackingJob extends WebhookChildJob
{
    public function __construct(private $contents)
    {
    }

    public function handle(RechargeGateway $rechargeGateway, EventTrackingService $eventTrackingService): void
    {
        $customer = $this->contents['customer'];
        $customerId = $customer['id'];
        $shopifyId = $customer['shopify_customer_id'];
        $user = User::query()->where('shopify_id', '=', $shopifyId)->first();
        if (!$user) {
            Log::error("User not found for shopify_id: $shopifyId");
            return;
        }

        $paymentMethod = $rechargeGateway->getCustomerDefaultPaymentMethod($customerId);
        $eventTrackingService->trackPaymentMethodExpiryDate($user, $paymentMethod);
    }
}
