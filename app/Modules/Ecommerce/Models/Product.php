<?php

namespace App\Modules\Ecommerce\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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
 * @method static ProductFactory factory(...$parameters)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereActive($value)
 * @method static Builder|Product whereAutoDecrementStock($value)
 * @method static Builder|Product whereBrand($value)
 * @method static Builder|Product whereCategory($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereDigitalAccessPermissionNames($value)
 * @method static Builder|Product whereDigitalAccessTimeIntervalLength($value)
 * @method static Builder|Product whereDigitalAccessTimeIntervalType($value)
 * @method static Builder|Product whereDigitalAccessTimeType($value)
 * @method static Builder|Product whereDigitalAccessType($value)
 * @method static Builder|Product whereFulfillmentSku($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereInventoryControlSku($value)
 * @method static Builder|Product whereIsPhysical($value)
 * @method static Builder|Product whereMinStockLevel($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereNote($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product wherePublicStockCount($value)
 * @method static Builder|Product whereSalesPageUrl($value)
 * @method static Builder|Product whereSku($value)
 * @method static Builder|Product whereStock($value)
 * @method static Builder|Product whereSubscriptionIntervalCount($value)
 * @method static Builder|Product whereSubscriptionIntervalType($value)
 * @method static Builder|Product whereThumbnailUrl($value)
 * @method static Builder|Product whereType($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product whereWeight($value)
 * @mixin Eloquent
 * @property Collection $userProducts
 */
class Product extends Model
{
    use CanSaveWithoutUpdatedAt;
    use HasFactory;
    use SoftDeletes;

    const TYPE_DIGITAL_SUBSCRIPTION = 'digital subscription';
    const TYPE_DIGITAL_ONE_TIME = 'digital one time';
    const TYPE_PHYSICAL_ONE_TIME = 'physical one time';

    const DIGITAL_ACCESS_TYPE_ALL_CONTENT_ACCESS = 'all content access';
    const DIGITAL_ACCESS_TYPE_BASIC_CONTENT_ACCESS = 'basic content access';
    const DIGITAL_ACCESS_TYPE_SPECIFIC_CONTENT_ACCESS = 'specific content access';

    const DIGITAL_ACCESS_TIME_TYPE_RECURRING = 'recurring';
    const DIGITAL_ACCESS_TIME_TYPE_ONE_TIME = 'one time';
    const DIGITAL_ACCESS_TIME_TYPE_LIFETIME = 'lifetime';

    const DIGITAL_PRODUCT_TYPES = [self::TYPE_DIGITAL_SUBSCRIPTION, self::TYPE_DIGITAL_ONE_TIME];

    const MEMBERSHIP_DIGITAL_ACCESS_TYPES = [DigitalAccessType::Plus, DigitalAccessType::Basic];

    protected $table = 'ecommerce_products';

    protected $primaryKey = 'id';

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    public function userProducts(): HasMany
    {
        return $this->hasMany(UserProduct::class);
    }

    public function isMembershipProduct(): bool
    {
        return in_array($this->getDigitalAccessTypeAsEnum(), Product::MEMBERSHIP_DIGITAL_ACCESS_TYPES);
    }

    public function isPack(): bool
    {
        return $this->digital_access_type == Product::DIGITAL_ACCESS_TYPE_SPECIFIC_CONTENT_ACCESS;
    }

    public function getDigitalAccessTypeAsEnum(): ?DigitalAccessType
    {
        return DigitalAccessType::tryFrom($this->digital_access_type);
    }

    public function calculateExpirationDate(Carbon $startedAt)
    {
        if ($this->digital_access_time_type == Product::DIGITAL_ACCESS_TIME_TYPE_LIFETIME) {
            return Carbon::maxValue();
        }
        $days = $this->getMembershipTimeDays();
        $months = $this->getMembershipTimeMonths();

        return $startedAt->clone()->addDays($days)->addMonths($months);
    }

    public function getMembershipTimeDays(): ?int
    {
        switch ($this->digital_access_time_interval_type) {
            case 'days':
                return $this->digital_access_time_interval_length ?? 0;
            case 'month':
            case 'year':
            case '':
                return 0;
        }
        Log::error(
            "Not Implemented membership time interval type: $this->digital_access_time_interval_type",
            [
                'product_id' => $this->id,
                'digital_access_time_interval_type' => $this->digital_access_time_interval_type,
            ]
        );
        return null;
    }

    public function getMembershipTimeMonths(): ?int
    {
        switch ($this->digital_access_time_interval_type) {
            case 'days':
            case '':
                return 0;
            case 'month':
                return $this->digital_access_time_interval_length;
            case 'year':
                return 12 * $this->digital_access_time_interval_length;
        }
        Log::error(
            "Not Implemented membership time interval type: $this->digital_access_time_interval_type",
            [
                'product_id' => $this->id,
                'digital_access_time_interval_type' => $this->digital_access_time_interval_type,
            ]
        );
        return null;
    }

    public function isLifeTime()
    {
        return $this->digital_access_time_interval_type == null || $this->digital_access_time_type == self::DIGITAL_ACCESS_TIME_TYPE_LIFETIME;
    }

    public function getContentPermissions($permissionsLookup): Collection
    {
        $permissionNames = collect($this->getDigitalAccessPermissionNames());
        return $permissionNames->map(function ($permissionName) use ($permissionsLookup) {
            $brand = $this->brand;
            $keyBrand = $brand . '_' . $permissionName;
            $keyGeneral = 'musora_' . $permissionName;
            $permission = $permissionsLookup[$keyBrand] ?? $permissionsLookup[$keyGeneral] ?? null;
            if (!$permission) {
                Log::error(
                    "Permission $brand - $permissionName does not exist.  Fix issue with product $this->id - $this->name and resync."
                );
                return false;
            }
            return $permission;
        });
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

    /**
     * @return int
     */
    public function getStockAvailability(): int
    {
        if ($this->min_stock_level === null || $this->stock === null) {
            return 1000000;
        }

        return intval($this->stock) - intval($this->min_stock_level);
    }

    public function isDigital(): bool
    {
        return in_array($this->type, self::DIGITAL_PRODUCT_TYPES);
    }

    public function isTrial(): bool{
        return str_contains(strtolower($this->sku), 'trial');
    }
}
