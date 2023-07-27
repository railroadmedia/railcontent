<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\CreditCardFactory;
use App\Modules\Ecommerce\database\factories\PaymentMethodFactory;
use App\Modules\Ecommerce\database\factories\UserProductFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StripeCustomer
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $id
 * @property integer user_id
 * @property string $stripe_customer_id
 * @property string $payment_gateway_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class StripeCustomer extends Model
{
    protected $table = 'ecommerce_user_stripe_customer_ids';
    protected $primaryKey = 'id';
}
