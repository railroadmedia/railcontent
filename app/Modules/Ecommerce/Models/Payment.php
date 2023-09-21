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
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class Payment extends Model
{
    const TYPE_APPLE_SUBSCRIPTION_RENEWAL = 'apple_subscription_renewal';
    const TYPE_GOOGLE_SUBSCRIPTION_RENEWAL = 'google_subscription_renewal';
    const STATUS_PAID = 'paid';

    protected $table = 'ecommerce_payments';
    protected $primaryKey = 'id';
}
