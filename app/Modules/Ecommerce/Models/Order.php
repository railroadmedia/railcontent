<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
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

    public function orderItemFullfillments(): HasMany
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

}
