<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\AddressFactory;
use App\Modules\Ecommerce\database\factories\CreditCardFactory;
use App\Modules\Ecommerce\database\factories\PaymentMethodFactory;
use App\Modules\Ecommerce\database\factories\UserProductFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $id
 * @property string $type
 * @property string $brand
 * @property integer $user_id
 * @property integer $customer_id
 * @property string $first_name
 * @property string $last_name
 * @property string $street_line_1
 * @property string $street_line_2
 * @property string $city
 * @property string $zip
 * @property string $region
 * @property string $country
 * @property string $note
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class Address extends Model
{
    use HasFactory;

    protected $table = 'ecommerce_addresses';
    protected $primaryKey = 'id';

    protected static function newFactory(): AddressFactory
    {
        return AddressFactory::new();
    }
}
