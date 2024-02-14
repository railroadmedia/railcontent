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
 *
 */
class SubscriptionPayment extends Model
{
    use CanSaveWithoutUpdatedAt;
    use HasShopifyMetafields;

    protected $table = 'ecommerce_subscription_payments';
    protected $primaryKey = 'id';

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
