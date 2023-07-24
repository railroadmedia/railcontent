<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $payment_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class OrderPayment extends Model
{
    protected $table = 'ecommerce_order_payments';
    protected $primaryKey = 'id';
}
