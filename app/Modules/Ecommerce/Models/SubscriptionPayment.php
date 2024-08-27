<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use App\Modules\Ecommerce\database\factories\SubscriptionPaymentFactory;
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
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class SubscriptionPayment
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property int $subscription_id
 * @property int $payment_id
 * @property int|null $shopify_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Subscription $subscription
 * @property-read Payment $payment
 *
 */
class SubscriptionPayment extends Model
{
    use HasFactory;
    use CanSaveWithoutUpdatedAt;
    use HasShopifyMetafields;

    protected $table = 'ecommerce_subscription_payments';
    protected $primaryKey = 'id';

    protected static function newFactory(): SubscriptionPaymentFactory
    {
        return SubscriptionPaymentFactory::new();
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function refunds(): BelongsToMany
    {
        return $this->belongsToMany(
            Refund::class,
            "ecommerce_payments",
            "id",
            "id",
            "payment_id",
            "payment_id"
        );
    }

    public function shopifyOrderFix(): MorphOne
    {
        return $this->morphOne(ShopifyOrderFix::class, 'ecommerce_modelable');
    }

    /**
     * Query scope to get subscription payments that need to be synced with Shopify, for the given constraints.
     */
    public function scopeToSyncWithShopify(
        Builder $query,
        ?int $startingId = null,
        ?int $endingId = null,
        ?bool $fresh = null,
        ?Carbon $startCreatedAt = null,
        ?Carbon $endCreatedAt = null
    ): void {
        $query
            ->when(
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
            ->whereHas('subscription', function ($query) {
                // we need to have a user or customer, otherwise we can't link the purchaser
                $query->whereNotNull('user_id')
                    ->orWhereNotNull('customer_id');
            })
            ->whereIn("payment_id", function ($query) {
                $query->select("id")
                    ->from("ecommerce_payments")
                    ->where("status", Payment::STATUS_PAID)
                    ->whereNotIn("type", [Payment::TYPE_INITIAL_ORDER, Payment::TYPE_PAYMENT_PLAN]);
            });
    }

    /**
     * @inheritDoc
     */
    public function getMetafieldsForShopify(): array
    {
        $metafields = [];

        /** @var Address $address */
        $address = $this->payment?->paymentMethod?->address ?? null;

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
