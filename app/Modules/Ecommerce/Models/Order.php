<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class Order extends Model
{
    protected $table = 'ecommerce_orders';
    protected $primaryKey = 'id';
}
