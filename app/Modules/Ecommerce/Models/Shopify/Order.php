<?php

namespace App\Modules\Ecommerce\Models\Shopify;

use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Order
{
    public string $gid;

    public int $id;
    public ?string $brand;
    public ShopifyPaymentSourceEnum $paymentSourceEnum;
    public Collection $lineItems;
    public ?Carbon $processedAt;
    public ?Carbon $cancelledAt;

    public function __construct($graphGLResponse)
    {
        $this->gid = $graphGLResponse->id;
        $this->id = str_replace('gid://shopify/Order/', '', $graphGLResponse->id);
        $this->brand = $graphGLResponse->brand?->value;
        $this->paymentSourceEnum = ShopifyPaymentSourceEnum::tryFrom(
            $graphGLResponse->paymentSource?->value
        ) ?? ShopifyPaymentSourceEnum::Web;
        $this->processedAt = $graphGLResponse->processedAt ? Carbon::parse($graphGLResponse->processedAt) : null;
        $this->cancelledAt = $graphGLResponse->cancelledAt ? Carbon::parse($graphGLResponse->cancelledAt) : null;
        $this->lineItems = collect($graphGLResponse->lineItems->nodes)->map(function ($item) {
            return new OrderLineItem($this, $item);
        });
    }

    public function getPaymentSourceEnum(): UserAccessPermissionsSourceEnum
    {
        switch ($this->paymentSourceEnum) {
            case ShopifyPaymentSourceEnum::Apple:
                return UserAccessPermissionsSourceEnum::Apple;
            case ShopifyPaymentSourceEnum::Google:
                return UserAccessPermissionsSourceEnum::Google;
            case ShopifyPaymentSourceEnum::Web:
            default:
                return UserAccessPermissionsSourceEnum::Web;
        }
    }

    public function setProducts(Collection $productLookup): void
    {
        $this->lineItems->each(function ($lineItem) use ($productLookup) {
            /** @var OrderLineItem $lineItem */
            $product = $productLookup[$lineItem->sku] ?? null;
            if (!$product) {
                Log::warning(
                    "Product $lineItem->sku does not exist.  Fix issue and resync order: $this->id"
                );
                return;
            }
            $lineItem->setProduct($product);
        });
    }
}
