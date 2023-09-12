<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property string $brand
 * @property string $name
 * @property string $sku
 * @property string $inventory_control_sku
 * @property string $fulfillment_sku
 * @property string $price
 * @property string $type
 * @property int $active
 * @property string $category
 * @property string $description
 * @property string $thumbnail_url
 * @property string $sales_page_url
 * @property int $is_physical
 * @property string $weight
 * @property string $subscription_interval_type
 * @property int $subscription_interval_count
 * @property int $stock
 * @property int $min_stock_level
 * @property int $public_stock_count
 * @property int $auto_decrement_stock
 * @property string $digital_access_permission_names
 * @property string $digital_access_type
 * @property string $digital_access_time_interval_type
 * @property string $digital_access_time_type
 * @property int $digital_access_time_interval_length
 * @property string $note
 * @property Carbon $digital_membership_access_expiration_date
 * @property Carbon $start_date
 * @property Carbon $expiration_date
 * @property int $shopify_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @method static \App\Modules\Ecommerce\database\factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAutoDecrementStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDigitalAccessPermissionNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDigitalAccessTimeIntervalLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDigitalAccessTimeIntervalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDigitalAccessTimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDigitalAccessType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFulfillmentSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInventoryControlSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsPhysical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMinStockLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePublicStockCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSalesPageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubscriptionIntervalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubscriptionIntervalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumbnailUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWeight($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;

    const TYPE_DIGITAL_SUBSCRIPTION = 'digital subscription';
    const TYPE_DIGITAL_ONE_TIME = 'digital one time';
    const TYPE_PHYSICAL_ONE_TIME = 'physical one time';

    const DIGITAL_ACCESS_TYPE_ALL_CONTENT_ACCESS = 'all content access';
    const DIGITAL_ACCESS_TYPE_BASIC_CONTENT_ACCESS = 'basic content access';
    const DIGITAL_ACCESS_TYPE_SPECIFIC_CONTENT_ACCESS = 'specific content access';

    const DIGITAL_ACCESS_TIME_TYPE_RECURRING = 'recurring';
    const DIGITAL_ACCESS_TIME_TYPE_ONE_TIME = 'one time';
    const DIGITAL_ACCESS_TIME_TYPE_LIFETIME = 'lifetime';


    const MEMBERSHIP_DIGITAL_ACCESS_TYPES = [DigitalAccessType::Plus, DigitalAccessType::Basic];

    protected $table = 'ecommerce_products';

    protected $primaryKey = 'id';

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    public function isMembershipProduct(): bool
    {
        return in_array($this->digital_access_type, Product::MEMBERSHIP_DIGITAL_ACCESS_TYPES);
    }

    public function getDigitalAccessPermissionNames(): array
    {
        if ($this->digital_access_permission_names == null) {
            return [];
        }

        return is_array($this->digital_access_permission_names) ? $this->digital_access_permission_names : json_decode(
            $this->digital_access_permission_names
        );
    }

    public function calculateExpirationDate(Carbon $createdAt)
    {
        if ($this->digital_access_time_type == Product::DIGITAL_ACCESS_TIME_TYPE_LIFETIME) {
            return Carbon::maxValue();
        }
        $interval = CarbonInterval::make(
            $this->digital_access_time_interval_length . ' ' . $this->digital_access_time_interval_type
        );

        return $createdAt->clone()->add($interval);
    }
}
