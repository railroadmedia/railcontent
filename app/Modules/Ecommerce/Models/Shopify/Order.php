<?php

namespace App\Modules\Ecommerce\Models\Shopify;

use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
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

    private float $totalPrice;
    private float $totalRefunded;

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
        $this->totalPrice = $graphGLResponse->totalPriceSet->shopMoney->amount;
        $this->totalRefunded = $graphGLResponse->totalRefundedSet->shopMoney->amount;
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

    public function isFullyRefunded(): bool
    {
        return $this->totalPrice > 0 && $this->totalRefunded >= $this->totalPrice;
    }

    public function getPermissionStatusFromOrder(): UserAccessPermissionsStatusEnum
    {
        if ($this->cancelledAt) {
            return UserAccessPermissionsStatusEnum::Revoked;
        }

        if ($this->processedAt > config('ecommerce.launch_dates.shopify')) {
            if ($this->isFullyRefunded()) {
                return UserAccessPermissionsStatusEnum::Revoked;
            }
        } else {
            if (!$this->isTrialOrder() && $this->totalPrice == 0) {
                //case for migration data that was refunded does not actually use refunds/cancellations
                return UserAccessPermissionsStatusEnum::Revoked;
            }
        }
        return UserAccessPermissionsStatusEnum::Active;
    }

    private
    function isTrialOrder()
    {
        return $this->lineItems->contains(function ($lineItem) {
            /** @var OrderLineItem $lineItem */
            return $lineItem->product->isTrial();
        });
    }
}
