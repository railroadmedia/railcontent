<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\PaymentMethodFactory;
use App\Modules\Ecommerce\database\factories\UserProductFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethod
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $id
 * @property integer $method_id
 * @property string $method_type
 * @property integer $credit_card_id
 * @property integer $paypal_billing_agreement_id
 * @property string $currency
 * @property integer $billing_address_id
 * @property string $note
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property ?CreditCard $creditCard
 * @property ?Address $address
 */
class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'ecommerce_payment_methods';
    protected $primaryKey = 'id';

    protected static function newFactory(): PaymentMethodFactory
    {
        return PaymentMethodFactory::new();
    }

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class, 'credit_card_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

}
