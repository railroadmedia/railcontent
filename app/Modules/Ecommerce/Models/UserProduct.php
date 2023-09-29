<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\UserProductFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserProduct
 *
 * @package App\Modules\Ecommerce\Models
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
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
 * @property Product $product
 */
class UserProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ecommerce_user_products';

    protected $primaryKey = 'id';

    protected static function newFactory(): UserProductFactory
    {
        return UserProductFactory::new();
    }

    public function scopeFromUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', '=', $userId);
    }

    /**
     * @return Product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
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

    public function isValidLifeTime()
    {
        if (empty($this->expiration_date) &&
            $this->product->isMembershipProduct() &&
            $this->product->digital_access_time_type == Product::DIGITAL_ACCESS_TIME_TYPE_LIFETIME) {
            return true;
        }
        return false;
    }


}
