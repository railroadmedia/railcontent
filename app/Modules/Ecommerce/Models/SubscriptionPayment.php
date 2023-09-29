<?php

namespace App\Modules\Ecommerce\Models;

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
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class SubscriptionPayment extends Model
{
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
}
