<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    use SoftDeletes;

    protected $table = 'ecommerce_orders';
    protected $primaryKey = 'id';

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
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
