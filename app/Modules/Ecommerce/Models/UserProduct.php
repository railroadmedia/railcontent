<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\UserProductFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserProduct
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $quantity
 * @property Carbon $start_date
 * @property Carbon $expiration_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class UserProduct extends Model
{
    use HasFactory;

    protected $table = 'ecommerce_user_products';

    protected $primaryKey = 'id';

    public function scopeFromUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', '=', $userId);
    }

    protected static function newFactory(): UserProductFactory
    {
        return UserProductFactory::new();
    }
}
