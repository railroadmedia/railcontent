<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\AddressFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Address
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property string $type
 * @property string $brand
 * @property int|null $user_id
 * @property int|null $customer_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $street_line_1
 * @property string|null $street_line_2
 * @property string|null $city
 * @property string|null $zip
 * @property string|null $region
 * @property int|null $shopify_id
 * @property string|null $country
 * @property string|null $note
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class Address extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ecommerce_addresses';
    protected $primaryKey = 'id';

    protected static function newFactory(): AddressFactory
    {
        return AddressFactory::new();
    }
}
