<?php

namespace App\Modules\Ecommerce\Models\Shopify\Rest;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Models\Order as EcommerceOrder;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Signifly\Shopify\REST\Resources\MetafieldResource;
use Signifly\Shopify\Shopify;

/**
 * Data Model for a Shopify Order, using the REST Admin API.
 */
class Order
{
    // DEV NOTE: this only has the attributes required so far. Please add to this, as needed.

    public const AUTOMATED_SOURCES = ['subscription_contract'];

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
    public ?string $currencyCode;
    public float $totalShipping;
    public array $discountCodes;
    public string $email;
    public array $tags;
    public ?string $sourceName;
    public string $financialStatus;
    public ?string $fulfillmentStatus;
    public ?Carbon $processedAt;
    public ?Customer $customer;
    public ?Address $billingAddress;
    public ?Address $shippingAddress;
    /** @var Collection<OrderLineItem> $lineItems */
    public Collection $lineItems;
    /** @var Collection<Fulfillment> $fulfillments */
    public Collection $fulfillments;
    public ?string $note;
    /** @var Collection<MetaField> */
    private Collection $_metafields;

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

        $this->financialStatus = $shopifyOrderData->financial_status;
        $this->discountCodes = $shopifyOrderData->discount_codes;
        $this->email = $shopifyOrderData->email;

        $this->customer = $shopifyOrderData->customer ? new Customer($shopifyOrderData->customer) : null;

        $this->billingAddress = $shopifyOrderData->billing_address ? new Address($shopifyOrderData->billing_address) : null;
        $this->shippingAddress = $shopifyOrderData->shipping_address ? new Address($shopifyOrderData->shipping_address) : null;

        $this->lineItems = collect($shopifyOrderData->line_items)->map(function ($item) {
            return new OrderLineItem($item);
        });

        $this->fulfillments = empty($shopifyOrderData->fulfillments) ? collect() :
            collect($shopifyOrderData->fulfillments)->map(function ($fulfillment) {
                return new Fulfillment($fulfillment);
            });

        $this->tags = empty($shopifyOrderData->tags) ? [] : array_map('trim', explode(',', $shopifyOrderData->tags));

        $this->currency = $shopifyOrderData->currency;
        $this->subtotalPrice = floatval($shopifyOrderData->subtotal_price);
        $this->totalDiscount = floatval($shopifyOrderData->total_discounts);
        $this->totalShipping = floatval($shopifyOrderData->total_shipping_price_set->shop_money->amount);
        $this->totalTax = floatval($shopifyOrderData->total_tax);
        $this->totalPrice = floatval($shopifyOrderData->total_price_set->shop_money->amount);
        $this->currencyCode = $shopifyOrderData->total_price_set->shop_money->currency_code;
        $this->sourceName = $shopifyOrderData->source_name;
        $this->financialStatus = $shopifyOrderData->financial_status;
        $this->fulfillmentStatus = $shopifyOrderData->fulfillment_status;
        $this->note = $shopifyOrderData->note;
        $this->_metafields = collect();
    }

    /**
     * @param  bool  $refresh  get a fresh copy of the Metafields from Shopify
     * @return Collection
     */
    public function getMetafields(bool $refresh = false): Collection
    {
        // save a hit to Shopify if we already have the metafields, unless we want to refresh it
        if (!$refresh && $this->_metafields->isNotEmpty()) {
            return $this->_metafields;
        }
        $shopify = app(Shopify::class);
        $metafields = $shopify->getOrderMetafields($this->id);
        try {
            $this->_metafields = $metafields->map(function (MetafieldResource $metafieldResource) {
                return new MetaField(
                    $metafieldResource->key,
                    (string)$metafieldResource->value,
                    ShopifyMetafieldTypes::from($metafieldResource->type),
                    $metafieldResource->namespace
                );
            });
        } catch (\ValueError $exception) {
            Log::error("Invalid Shopify Metafield value for expected enum: ".$exception->getMessage());
        }
        return $this->_metafields;
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

    /**
     * Get the ecommerce Order or SubscriptionPayment model that's associated with this Shopify Order.
     *
     * @return EcommerceOrder|SubscriptionPayment
     * @throws ModelNotFoundException
     */
    public function getEcommerceModel(): EcommerceOrder|SubscriptionPayment
    {
        // get the metafield entry with our model
        $metafields = $this->getMetafields();
        /** @var MetaField $modelIdMetafield */
        $modelIdMetafield = $metafields->filter(function (MetaField $metaField) {
            return $metaField->key === ShopifyMetafieldKey::Id->value
                && (in_array($metaField->namespace, [ShopifyMetafieldNamespace::Model_Orders->value, ShopifyMetafieldNamespace::Model_SubscriptionPayments->value]));
        })->first();

        if ($modelIdMetafield) {
            return match ($modelIdMetafield->namespace) {
                ShopifyMetafieldNamespace::Model_Orders->value => EcommerceOrder::findOrFail($modelIdMetafield->value),
                ShopifyMetafieldNamespace::Model_SubscriptionPayments->value => SubscriptionPayment::findOrFail($modelIdMetafield->value),
            };
        } else {
            // we don't have the metafield record for some reason, so try to find our record with this ID
            $ecommerceModel = EcommerceOrder::firstWhere('shopify_id', $this->id);
            if ($ecommerceModel) {
                return $ecommerceModel;
            }
            $ecommerceModel = SubscriptionPayment::firstWhere('shopify_id', $this->id);
            if ($ecommerceModel) {
                return $ecommerceModel;
            }
        }
        throw new ModelNotFoundException("No ecommerce model found for Shopify Order {$this->id}");
    }
}
