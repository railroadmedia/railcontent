<?php

namespace App\Modules\Ecommerce\Models\Shopify\Rest;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Data Model for a Shopify Order, using the REST Admin API.
 */
class Order
{
    // DEV NOTE: this only has the attributes required so far. Please add to this, as needed.

    public string $gid;
    public int $id;
    public ?string $name;
    public ?int $orderNumber;
    public Carbon $createdAt;
    public string $currency;
    public float $subtotalPrice;
    public float $totalDiscount;
    public float $totalTax;
    public float $totalPrice;
    public float $totalShipping;
    public array $discountCodes;
    public string $email;
    public array $tags;
    public ?Carbon $processedAt;
    public ?Customer $customer;
    /** @var Collection<OrderLineItem> $lineItems */
    public Collection $lineItems;


    public function __construct($shopifyOrderData)
    {
        $this->id = $shopifyOrderData->id;
        $this->gid = $shopifyOrderData->admin_graphql_api_id;

        $this->name = $shopifyOrderData->name;
        if (preg_match('/#\d*/', $this->name, $match)) {
            $this->orderNumber = intval(preg_replace('/#/', '', $match[0]));
        }

        $this->createdAt = Carbon::parse($shopifyOrderData->created_at);
        $this->processedAt = $shopifyOrderData->processed_at ? Carbon::parse($shopifyOrderData->processed_at) : null;

        $this->discountCodes = $shopifyOrderData->discount_codes;
        $this->email = $shopifyOrderData->email;

        $this->customer = $shopifyOrderData->customer ? new Customer($shopifyOrderData->customer) : null;

        $this->lineItems = collect($shopifyOrderData->line_items)->map(function ($item) {
            return new OrderLineItem($item);
        });

        $this->tags = empty($shopifyOrderData->tags) ? [] : array_map('trim', explode(',', $shopifyOrderData->tags));

        $this->currency = $shopifyOrderData->currency;
        $this->subtotalPrice = floatval($shopifyOrderData->subtotal_price);
        $this->totalDiscount = floatval($shopifyOrderData->total_discounts);
        $this->totalShipping = floatval($shopifyOrderData->total_shipping_price_set->shop_money->amount);
        $this->totalTax = floatval($shopifyOrderData->total_tax);
        $this->totalPrice = floatval($shopifyOrderData->total_price_set->shop_money->amount);
    }

    /**
     * Get if this order is for a trial
     *
     * @return bool
     */
    public function isTrialOrder(): bool
    {
        return $this->lineItems->contains(function ($lineItem) {
            /** @var OrderLineItem $lineItem */
            return $lineItem->isTrial();
        });
    }

    /**
     * Get if this order is for a membership
     *
     * @return bool
     */
    public function isMembershipOrder(): bool
    {
        return $this->lineItems->contains(function ($lineItem) {
            /** @var OrderLineItem $lineItem */
            return $lineItem->isMembership();
        });
    }
}
