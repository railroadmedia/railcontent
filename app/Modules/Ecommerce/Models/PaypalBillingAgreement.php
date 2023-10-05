<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PaypalBillingAgreements
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property string $external_id
 * @property string $payment_gateway_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class PaypalBillingAgreement extends Model
{
    use SoftDeletes;

    protected $table = 'ecommerce_paypal_billing_agreements';
    protected $primaryKey = 'id';
}
