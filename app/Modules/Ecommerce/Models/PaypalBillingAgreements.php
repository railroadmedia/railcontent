<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaypalBillingAgreements
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $id
 * @property string $external_id
 * @property string $payment_gateway_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class PaypalBillingAgreements extends Model
{
    protected $table = 'ecommerce_paypal_billing_agreements';
    protected $primaryKey = 'id';
}
