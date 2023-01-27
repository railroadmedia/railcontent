<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\UserPaymentMethodFactory;
use App\Modules\Ecommerce\database\factories\UserProductFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserPaymentMethod
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $payment_method_id
 * @property integer $is_primary
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserPaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'ecommerce_user_payment_methods';
    protected $primaryKey = 'id';

    protected static function newFactory(): UserPaymentMethodFactory
    {
        return UserPaymentMethodFactory::new();
    }
}
