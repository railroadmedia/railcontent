<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\PaymentMethodFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PaymentMethod
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property int $method_id
 * @property string $method_type
 * @property int $credit_card_id
 * @property int $paypal_billing_agreement_id
 * @property string $currency
 * @property int $billing_address_id
 * @property string $note
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property ?CreditCard $creditCard
 * @property ?Address $address
 * @property ?PaypalBillingAgreement $paypalBillingAgreement */
class PaymentMethod extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function paypalBillingAgreement()
    {
        return $this->belongsTo(PaypalBillingAgreement::class, 'paypal_billing_agreement_id');
    }

}
