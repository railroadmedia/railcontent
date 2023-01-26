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
 * Class CreditCard
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $id
 * @property string $fingerprint
 * @property string $last_four_digits
 * @property string $cardholder_name
 * @property string $company_name
 * @property Carbon $expiration_date
 * @property string $external_id
 * @property string $external_customer_id
 * @property string $payment_gateway_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CreditCard extends Model
{
    use HasFactory;

    protected $table = 'ecommerce_credit_cards';
    protected $primaryKey = 'id';

    protected static function newFactory(): CreditCardFactory
    {
        return CreditCardFactory::new();
    }
}
