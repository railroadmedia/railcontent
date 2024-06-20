<?php

namespace App\Modules\Ecommerce\Models\Recharge;

use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;

class Subscription
{
    public ?string $cancellationReason;
    public ?Carbon $cancelledAt;
    public ?Carbon $updatedAt;

    public ?Carbon $createdAt;
    public int $id;
    public int $customerId;
    public ?string $email = null;
    public ?Product $product = null;
    public ?int $shopifyVariantId;
    public string $status;
    public ?string $sku;
    public ?Carbon $nextChargeScheduledAt;

    public function __construct($subscriptionData)
    {
        $this->id = $subscriptionData->id;
        $this->customerId = $subscriptionData->customer_id;
        $this->email = $subscriptionData->email ?? null;
        $this->createdAt = $subscriptionData->created_at ? Carbon::parse($subscriptionData->created_at) : null;

        $this->cancellationReason = $subscriptionData->cancellation_reason;
        $this->cancelledAt = $subscriptionData->cancelled_at ? Carbon::parse($subscriptionData->cancelled_at) : null;
        $this->status = $subscriptionData->status;
        $this->sku = $subscriptionData->sku;
        $this->nextChargeScheduledAt = $subscriptionData->next_charge_scheduled_at ? Carbon::parse($subscriptionData->next_charge_scheduled_at) : null;
        $this->shopifyVariantId = $subscriptionData->shopify_variant_id ?? null;
        $this->updatedAt = $subscriptionData->updated_at ? Carbon::parse($subscriptionData->updated_at) : null;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
