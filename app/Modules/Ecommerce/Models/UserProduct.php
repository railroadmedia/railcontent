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
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $quantity
 * @property Carbon $start_date
 * @property Carbon $expiration_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property int $id
 * @method static \App\Modules\Ecommerce\database\factories\UserProductFactory factory(...$parameters)
 * @method static Builder|UserProduct fromUser(int $userId)
 * @method static Builder|UserProduct newModelQuery()
 * @method static Builder|UserProduct newQuery()
 * @method static Builder|UserProduct query()
 * @method static Builder|UserProduct whereCreatedAt($value)
 * @method static Builder|UserProduct whereDeletedAt($value)
 * @method static Builder|UserProduct whereExpirationDate($value)
 * @method static Builder|UserProduct whereId($value)
 * @method static Builder|UserProduct whereProductId($value)
 * @method static Builder|UserProduct whereQuantity($value)
 * @method static Builder|UserProduct whereStartDate($value)
 * @method static Builder|UserProduct whereUpdatedAt($value)
 * @method static Builder|UserProduct whereUserId($value)
 * @mixin \Eloquent
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

    public function isValid(): bool
    {
        if ((empty($this->expiration_date) || $this->expiration_date > Carbon::now()) &&
            (empty($this->start_date) || $this->start_date < Carbon::now()) &&
            empty($this->deleted_at)) {
            return true;
        }

        return false;
    }
}
