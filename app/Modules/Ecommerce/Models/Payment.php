<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use App\Modules\Ecommerce\database\factories\PaymentFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class Payment
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property string $type
 * @property string|null $note
 * @property int|null $shopify_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<GoogleReceipt> $googleReceipts
 * @property-read Collection<AppleReceipt> $appleReceipts
 *
 */
class Payment extends Model
{
    use HasFactory;
    use CanSaveWithoutUpdatedAt;
    use SoftDeletes;

    public const TYPE_APPLE_SUBSCRIPTION_RENEWAL = 'apple_subscription_renewal';
    public const TYPE_GOOGLE_SUBSCRIPTION_RENEWAL = 'google_subscription_renewal';
    public const TYPE_INITIAL_ORDER = 'initial_order';
    public const TYPE_PAYMENT_PLAN = 'payment_plan';
    public const TYPE_PAYPAL_SUBSCRIPTION_RENEWAL = 'paypal_subscription_renewal';
    public const TYPE_SUBSCRIPTION_RENEWAL = 'subscription_renewal';
    public const STATUS_PAID = 'paid';
    public const STATUS_FAILED = 'failed';
    public const STATUS_REFUNDED = 'refunded';

    public const EXTERNAL_PROVIDER_STRIPE = 'stripe';
    public const EXTERNAL_PROVIDER_PAYPAL = 'paypal';
    public const EXTERNAL_PROVIDER_APPLE = 'apple';
    public const EXTERNAL_PROVIDER_GOOGLE = 'google';

    protected $table = 'ecommerce_payments';
    protected $primaryKey = 'id';

    protected static function newFactory(): PaymentFactory
    {
        return PaymentFactory::new();
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, "ecommerce_order_payments");
    }

    public function orderPayments(): HasMany
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function refunds(): HasMany
    {
        return $this->hasMany(Refund::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function googleReceipts(): HasMany
    {
        return $this->hasMany(GoogleReceipt::class, 'order_id', 'external_id')
            ->when($this->external_provider !== 'google', function ($q) {
                // return an empty HasMany by using an impossible condition
                $q->whereRaw('1 = 0');
            });
    }

    public function appleReceipts(): HasMany
    {
        return $this->hasMany(AppleReceipt::class, 'transaction_id', 'external_id')
            ->when($this->external_provider !== 'apple', function ($q) {
                // return an empty HasMany by using an impossible condition
                $q->whereRaw('1 = 0');
            });
    }
}
