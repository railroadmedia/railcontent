<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OrderItemFulfillment
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property int quantity
 * @property string status
 * @property string|null company
 * @property string|null tracking_number
 * @property Carbon|null fulfilled_on
 * @property int|null $shopify_id
 * @property string|null $note
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class OrderItemFulfillment extends Model
{
    protected $table = 'ecommerce_order_item_fulfillment';
    protected $primaryKey = 'id';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }
}
