<?php

namespace App\Modules\Ecommerce\Models\Shopify;

use App\Modules\Ecommerce\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

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
 * @property-read Collection<Payment> $payments
 *
 */
class ShopifyOrderFix extends Model
{
    use SoftDeletes;

    public const ACTION_MATCHED = 'matched';
    public const ACTION_REPLACED = 'replaced';
    public const ACTION_FAILURE = 'failure';
    public const ACTIONS = [self::ACTION_MATCHED, self::ACTION_REPLACED, self::ACTION_FAILURE];
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_CLONED = 'cloned';
    public const STATUS_PAID = 'paid';
    public const STATUS_FULFILLED = 'fulfilled';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_EVALUATED = 'evaluated';
    public const STATUSES = [self::STATUS_PROCESSING, self::STATUS_CLONED, self::STATUS_PAID, self::STATUS_FULFILLED, self::STATUS_COMPLETED, self::STATUS_EVALUATED];

    protected $table = 'shopify_order_fixes';

    protected $guarded = ['id'];

    public function ecommerceModelable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'ecommerce_modelable_type', 'ecommerce_modelable_id');
    }
}
