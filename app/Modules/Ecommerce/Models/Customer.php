<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property string|null $phone
 * @property string|null $email
 * @property string $brand
 * @property int|null $shopify_id
 * @property string|null $note
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Customer extends Model
{
    protected $table = 'ecommerce_customers';
    protected $primaryKey = 'id';
}
