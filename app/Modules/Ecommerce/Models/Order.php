<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use App\Modules\Ecommerce\database\factories\OrderFactory;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use App\Modules\Ecommerce\Models\Shopify\ShopifyOrderFix;
use App\Modules\Ecommerce\Models\Traits\HasShopifyMetafields;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
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
 * @property-read Collection<Payment> $payments
 *
 */
class Order extends Model
{
    use HasFactory;
    use CanSaveWithoutUpdatedAt;
    use HasShopifyMetafields;
    use SoftDeletes;

    protected $table = 'ecommerce_orders';
    protected $primaryKey = 'id';

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }

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

    public function shopifyOrderFix(): MorphOne
    {
        return $this->morphOne(ShopifyOrderFix::class, 'ecommerce_modelable');
    }

    /**
     * Query scope to get orders that need to be synced with Shopify, for the given constraints.
     */
    public function scopeToSyncWithShopify(
        Builder $query,
        ?int $startingId = null,
        ?int $endingId = null,
        ?bool $fresh = null,
        ?Carbon $startCreatedAt = null,
        ?Carbon $endCreatedAt = null
    ): void {
        $query->when(
            !is_null($startingId) && !is_null($endingId),
            function (Builder $q) use ($startingId, $endingId) {
                return $q->whereBetween("id", [$startingId, $endingId]);
            },
            function (Builder $q) use ($startingId) {
                return $q->when(!is_null($startingId), function (Builder $q) use ($startingId) {
                    return $q->where("id", ">=", $startingId);
                });
            },
        )
            ->when(!$fresh, function (Builder $q) {
                return $q->whereNull("shopify_id");
            })
            ->when(
                !is_null($startCreatedAt) && !is_null($endCreatedAt),
                function (Builder $q) use ($startCreatedAt, $endCreatedAt) {
                    return $q->whereBetween(
                        'created_at',
                        [$startCreatedAt->toDateTimeString(), $endCreatedAt->toDateTimeString()]
                    );
                }
            )
            ->whereHas('orderItems');
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
                ShopifyMetafieldNamespace::Musora
            );
        }
        if ($address?->country) {
            $metafields[] = new MetaField(
                ShopifyMetafieldKey::AddressCountry,
                $address->country,
                ShopifyMetafieldTypes::single_line_text_field,
                ShopifyMetafieldNamespace::Musora
            );
        }
        return $metafields;
    }
}
