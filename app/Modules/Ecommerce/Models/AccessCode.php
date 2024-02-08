<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use App\Modules\Ecommerce\database\factories\AccessCodeFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Modules\UserManagementSystem\Models\User;

/**
 * Class AccessCode
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property string $code
 * @property string $product_ids
 * @property bool $is_claimed
 * @property int $claimer_id
 * @property Carbon $claimed_on
 * @property string $brand
 * @property string $note
 * @property string $source
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $claimer
 * @property-read Product $product
 */
class AccessCode extends Model
{
    use HasFactory;

    protected $table = 'ecommerce_access_codes';
    protected $primaryKey = 'id';


    public static function generateNewCode(): string
    {
        return bin2hex(openssl_random_pseudo_bytes(24 / 2));
    }

    protected static function newFactory(): AccessCodeFactory
    {
        return AccessCodeFactory::new();
    }

    public function generateCode(): void
    {
        $this->setCode(bin2hex(openssl_random_pseudo_bytes(24 / 2)));
    }

    public function getProductIdsAsString(): ?string
    {
        return implode(", ", $this->product_ids);
    }

    public function claimer()
    {
        return $this->belongsTo(User::class, 'claimer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_ids');
    }

    public function scopeOrderByRequest(Builder $query, Request $request): void
    {
        $defaultOrderByColumn = 'created_at';
        $defaultOrderByDirection = 'desc';

        $orderByColumn = $request->get('order_by_column', $defaultOrderByColumn);
        $orderByDirection = $request->get('order_by_direction', $defaultOrderByDirection);
        if ($orderByDirection == 'desc') {
            $query->orderByDesc($orderByColumn);
        } else {
            $query->orderBy($orderByColumn);
        }
    }

}
