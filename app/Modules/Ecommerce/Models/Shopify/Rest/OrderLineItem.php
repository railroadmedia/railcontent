<?php

namespace App\Modules\Ecommerce\Models\Shopify\Rest;

use App\Modules\Ecommerce\Models\Product;

/**
 * Data Model for a Shopify Order Line Item, using the REST Admin API.
 */
class OrderLineItem
{
    // DEV NOTE: this only has the attributes required so far. Please add to this, as needed.

    public string $gid;
    public int $id;
    public ?int $variantId;
    public ?int $productId;
    public string $sku;
    public ?Product $product = null;
    /** @var float $price the original price of the item */
    public float $price;
    public string $currency;
    public int $quantity;
    public float $discount;
    /** @var float $totalPrice the total price of the item, after discount */
    public float $totalPrice;
    public bool $taxable;
    public int $grams;
    public string $name;
    public ?string $productTitle;
    public ?string $variantTitle;
    public string $vendor;
    public int $fulfillableQuantity;
    public string $fulfillmentService;
    public bool $requiresShipping;


    public function __construct($shopifyLineItemData)
    {
        $this->id = $shopifyLineItemData->id;
        $this->gid = $shopifyLineItemData->admin_graphql_api_id;
        $this->currency = $shopifyLineItemData->price_set->shop_money->currency_code;
        $this->price = floatval($shopifyLineItemData->price_set->shop_money->amount);
        $this->discount = $this->calculateDiscount($shopifyLineItemData);
        $this->quantity = $shopifyLineItemData->quantity;
        $this->sku = $shopifyLineItemData->sku;
        $this->variantId = $shopifyLineItemData->variant_id;
        $this->productId = $shopifyLineItemData->product_id;
        $this->product = Product::withTrashed()->firstWhere('sku', $this->sku);
        $this->totalPrice = ($this->price * $this->quantity) - $this->discount;
        $this->grams = $shopifyLineItemData->grams;
        $this->name = $shopifyLineItemData->name;
        $this->productTitle = $shopifyLineItemData->title;
        $this->variantTitle = $shopifyLineItemData->variant_title;
        $this->fulfillableQuantity = $shopifyLineItemData->fulfillable_quantity;
        $this->fulfillmentService = $shopifyLineItemData->fulfillment_service;
        $this->requiresShipping = $shopifyLineItemData->requires_shipping;
        $this->vendor = $shopifyLineItemData->vendor;
        $this->taxable = $shopifyLineItemData->taxable;
    }

    /**
     * Calculate the discount applied to this order line item
     *
     * @param $shopifyLineItemData
     */
    private function calculateDiscount($shopifyLineItemData): float
    {
        $totalDiscount = 0;
        /** @var array $discountAllocations */
        $discountAllocations = $shopifyLineItemData->discount_allocations;
        foreach ($discountAllocations as $discountAllocation) {
            $totalDiscount += floatval($discountAllocation->amount_set->shop_money->amount);
        }
        return $totalDiscount;
    }

    /**
     * Get if this line item is for a trial
     */
    public function isTrial(): bool
    {
        return $this->product?->isTrial() ?? false;
    }

    /**
     * Get if this line item is for a membership
     */
    public function isMembership(): bool
    {
        return $this->product?->isMembershipProduct() ?? false;
    }
}
