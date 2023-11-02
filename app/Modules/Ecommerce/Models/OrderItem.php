<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class OrderItem
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property int quantity
 * @property float|null weight
 * @property float initial_price
 * @property float total_discounted
 * @property float final_price
 * @property int|null $shopify_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class OrderItem extends Model
{
    use CanSaveWithoutUpdatedAt;

    protected $table = 'ecommerce_order_items';
    protected $primaryKey = 'id';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItemFulfillments(): HasMany
    {
        return $this->hasMany(OrderItemFulfillment::class);
    }

}
