<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property int|null $shopify_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class Payment extends Model
{
    use CanSaveWithoutUpdatedAt;
    use SoftDeletes;

    public const TYPE_APPLE_SUBSCRIPTION_RENEWAL = 'apple_subscription_renewal';
    public const TYPE_GOOGLE_SUBSCRIPTION_RENEWAL = 'google_subscription_renewal';
    public const STATUS_PAID = 'paid';

    protected $table = 'ecommerce_payments';
    protected $primaryKey = 'id';

    public function refunds(): HasMany
    {
        return $this->hasMany(Refund::class);
    }
}
