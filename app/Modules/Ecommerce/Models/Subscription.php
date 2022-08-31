<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\SubscriptionFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * @internal
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property string $brand
 * @property string $type
 * @property integer $user_id
 * @property ?integer $customer_id
 * @property integer $order_id
 * @property integer $product_id
 * @property bool $is_active
 * @property bool $stopped
 * @property Carbon $start_date
 * @property Carbon $paid_until
 * @property Carbon $canceled_on
 * @property string $cancellation_reason
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class Subscription extends Model
{
    use HasFactory;

    protected $table = 'ecommerce_subscriptions';

    protected $primaryKey = 'id';

    const TYPE_SUBSCRIPTION = 'subscription';

    public function scopeFromUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', '=', $userId);
    }

    public function scopeNotCancelled(Builder $query): Builder
    {
        return $query->where('canceled_on', 'is', null);
    }

    protected static function newFactory(): SubscriptionFactory
    {
        return SubscriptionFactory::new();
    }
}
