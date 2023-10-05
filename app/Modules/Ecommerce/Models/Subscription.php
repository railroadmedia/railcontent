<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\SubscriptionFactory;
use App\Modules\Ecommerce\Enums\SubscriptionIntervalType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\UserManagementSystem\Models\User;

/**
 * Class Subscription
 *
 * @package App\Modules\Ecommerce\Models
 * @property int $id
 * @property string $brand
 * @property string $type
 * @property int $user_id
 * @property ?int $customer_id
 * @property int $order_id
 * @property int $product_id
 * @property bool $is_active
 * @property bool $stopped
 * @property Carbon $start_date
 * @property Carbon $paid_until
 * @property Carbon $canceled_on
 * @property string $cancellation_reason
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property ?Product $product
 * @property string|null $note
 * @property string $total_price
 * @property float $tax
 * @property string $currency
 * @property string $interval_type
 * @property int $interval_count
 * @property int|null $total_cycles_due
 * @property int $total_cycles_paid
 * @property int $renewal_attempt
 * @property int|null $payment_method_id
 * @property string|null $apple_expiration_date
 * @property string|null $external_app_store_id
 * @property string|null $paypal_recurring_profile_id
 * @property int|null $failed_payment_id
 * @property-read User|null $user
 * @property ?PaymentMethod $paymentMethod
 * @method static \App\Modules\Ecommerce\database\factories\SubscriptionFactory factory(...$parameters)
 * @method static Builder|Subscription fromUser(int $userId)
 * @method static Builder|Subscription newModelQuery()
 * @method static Builder|Subscription newQuery()
 * @method static Builder|Subscription notCancelled()
 * @method static Builder|Subscription query()
 * @method static Builder|Subscription whereAppleExpirationDate($value)
 * @method static Builder|Subscription whereBrand($value)
 * @method static Builder|Subscription whereCanceledOn($value)
 * @method static Builder|Subscription whereCancellationReason($value)
 * @method static Builder|Subscription whereCreatedAt($value)
 * @method static Builder|Subscription whereCurrency($value)
 * @method static Builder|Subscription whereCustomerId($value)
 * @method static Builder|Subscription whereDeletedAt($value)
 * @method static Builder|Subscription whereExternalAppStoreId($value)
 * @method static Builder|Subscription whereFailedPaymentId($value)
 * @method static Builder|Subscription whereId($value)
 * @method static Builder|Subscription whereIntervalCount($value)
 * @method static Builder|Subscription whereIntervalType($value)
 * @method static Builder|Subscription whereIsActive($value)
 * @method static Builder|Subscription whereNote($value)
 * @method static Builder|Subscription whereOrderId($value)
 * @method static Builder|Subscription wherePaidUntil($value)
 * @method static Builder|Subscription wherePaymentMethodId($value)
 * @method static Builder|Subscription wherePaypalRecurringProfileId($value)
 * @method static Builder|Subscription whereProductId($value)
 * @method static Builder|Subscription whereRenewalAttempt($value)
 * @method static Builder|Subscription whereStartDate($value)
 * @method static Builder|Subscription whereStopped($value)
 * @method static Builder|Subscription whereTax($value)
 * @method static Builder|Subscription whereTotalCyclesDue($value)
 * @method static Builder|Subscription whereTotalCyclesPaid($value)
 * @method static Builder|Subscription whereTotalPrice($value)
 * @method static Builder|Subscription whereType($value)
 * @method static Builder|Subscription whereUpdatedAt($value)
 * @method static Builder|Subscription whereUserId($value)
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TYPE_SUBSCRIPTION = 'subscription';
    const TYPE_APPLE_SUBSCRIPTION = 'apple_subscription';
    const TYPE_GOOGLE_SUBSCRIPTION = 'google_subscription';
    const TYPE_PAYPAL_SUBSCRIPTION = 'paypal_recurring_profile_subscription';
    const TYPE_PAYMENT_PLAN = 'payment plan';

    // log actions names
    const ACTION_RENEW = 'renew';
    const ACTION_CANCEL = 'cancel';
    const ACTION_DEACTIVATED = 'deactivated';

    // states
    const STATE_ACTIVE = 'active';
    const STATE_SUSPENDED = 'suspended';
    const STATE_CANCELED = 'canceled';
    const STATE_STOPPED = 'stopped';

    protected $table = 'ecommerce_subscriptions';

    protected $primaryKey = 'id';

    protected static function newFactory(): SubscriptionFactory
    {
        return SubscriptionFactory::new();
    }

    public function scopeFromUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', '=', $userId);
    }

    public function scopeNotCancelled(Builder $query): Builder
    {
        return $query->where('canceled_on', 'is', null);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function getIntervalType(): SubscriptionIntervalType
    {
        return match ($this->interval_type) {
            'month', 'monthly' => SubscriptionIntervalType::Month,
            'year', 'yearly' => SubscriptionIntervalType::Year,
            default => SubscriptionIntervalType::Unknown,
        };
    }

    public function cancel(string $cancellationReason): void
    {
        $this->canceled_on = Carbon::now();
        $this->cancellation_reason = $cancellationReason;
        $this->is_active = 0;
    }

    public function isCancelled(): bool
    {
        return $this->canceled_on;
    }

    public function isMobile(): bool
    {
        return $this->type == Subscription::TYPE_APPLE_SUBSCRIPTION || $this->type == Subscription::TYPE_GOOGLE_SUBSCRIPTION;
    }


}
