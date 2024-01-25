<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use App\Modules\Ecommerce\Models\Traits\HasShopifyMetafields;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\UserManagementSystem\Models\User;

/**
 * Class Order
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property int|null $shopify_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class Order extends Model
{
    use CanSaveWithoutUpdatedAt;
    use HasShopifyMetafields;
    use SoftDeletes;
    protected $table = 'ecommerce_orders';
    protected $primaryKey = 'id';

    public function payments(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class, "ecommerce_order_payments");
    }

    public function refunds(): HasManyThrough
    {
        return $this->hasManyThrough(
            Refund::class,
            OrderPayment::class,
            "payment_id",
            "payment_id",
            "id",
            "id"
        );
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderItemFulfillments(): HasMany
    {
        return $this->hasMany(OrderItemFulfillment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function placedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, "placed_by_user_id");
    }

    public function shippingAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function billingAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

    /**
     * @inheritDoc
     */
    public function getMetafieldsForShopify(): array
    {
        $metafields = [];

        /** @var Address $address */
        $address = $this->shippingAddress ?? $this->billingAddress;

        if ($address?->region) {
            $metafields[] = new MetaField(
                ShopifyMetafieldKey::AddressRegion,
                $address->region,
                ShopifyMetafieldTypes::single_line_text_field,
                ShopifyMetafieldNamespace::Model_Orders
            );
        }
        if ($address?->country) {
            $metafields[] = new MetaField(
                ShopifyMetafieldKey::AddressCountry,
                $address->country,
                ShopifyMetafieldTypes::single_line_text_field,
                ShopifyMetafieldNamespace::Model_Orders
            );
        }
        return $metafields;
    }
}
