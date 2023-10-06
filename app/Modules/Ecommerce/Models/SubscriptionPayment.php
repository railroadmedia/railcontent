<?php

namespace Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $id
 * @property integer $subscription_id
 * @property integer $payment_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class SubscriptionPayment extends Model
{
    protected $table = 'ecommerce_subscription_payments';
    protected $primaryKey = 'id';
}
