<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderPayment
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property int $order_id
 * @property int $payment_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class OrderPayment extends Model
{
    protected $table = 'ecommerce_order_payments';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
