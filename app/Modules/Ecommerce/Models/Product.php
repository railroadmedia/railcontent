<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\database\factories\ProductFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property string brand
 * @property string name
 * @property string sku
 * @property string inventory_control_sku
 * @property string fulfillment_sku
 * @property float price
 * @property string type
 * @property boolean active
 * @property string category
 * @property string description
 * @property string thumbnail_url
 * @property string sales_page_url
 * @property boolean is_physical
 * @property float weight
 * @property string subscription_interval_type
 * @property integer subscription_interval_count
 * @property string stock
 * @property string min_stock_level
 * @property string public_stock_count
 * @property string auto_decrement_stock
 * @property array digital_access_permission_names
 * @property string digital_access_type
 * @property string digital_access_time_type
 * @property string digital_access_time_interval_length
 * @property string note
 * @property Carbon $start_date
 * @property Carbon $expiration_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 */
class Product extends Model
{
    use HasFactory;

    const TYPE_DIGITAL_SUBSCRIPTION = 'digital subscription';
    const TYPE_DIGITAL_ONE_TIME = 'digital one time';
    const TYPE_PHYSICAL_ONE_TIME = 'physical one time';

    const DIGITAL_ACCESS_TYPE_ALL_CONTENT_ACCESS = 'all content access';
    const DIGITAL_ACCESS_TYPE_SPECIFIC_CONTENT_ACCESS = 'specific content access';

    const DIGITAL_ACCESS_TIME_TYPE_RECURRING = 'recurring';
    const DIGITAL_ACCESS_TIME_TYPE_ONE_TIME = 'one time';
    const DIGITAL_ACCESS_TIME_TYPE_LIFETIME = 'lifetime';

    const DIGITAL_ACCESS_TIME_INTERVAL_TYPE_DAY = 'day';
    const DIGITAL_ACCESS_TIME_INTERVAL_TYPE_MONTH = 'month';
    const DIGITAL_ACCESS_TIME_INTERVAL_TYPE_YEAR = 'year';

    protected $table = 'ecommerce_products';

    protected $primaryKey = 'id';

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
