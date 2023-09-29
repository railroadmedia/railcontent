<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    use CanSaveWithoutUpdatedAt;

    protected $table = 'ecommerce_customers';
    protected $primaryKey = 'id';

    public function shippingAddresses(): HasMany
    {
        return $this->hasMany(Address::class, "customer_id"
        )->where("type", Address::SHIPPING_TYPE);
    }

    public function billingAddresses(): HasMany
    {
        return $this->hasMany(Address::class, "customer_id")
            ->where("type", Address::BILLING_TYPE);
    }
}
