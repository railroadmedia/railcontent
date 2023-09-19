<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Ecommerce\Enums\MembershipTimeStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserProduct
 *
 * @package App\Modules\Ecommerce\Models
 * @property integer $user_id
 * @property integer $shopify_order_id
 * @property integer $shopify_variant_id
 * @property Carbon $order_created_at
 * @property integer $membership_time_days
 * @property integer $membership_time_months
 * @property MembershipTimeStatus $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $id
 */
class MembershipTime extends Model
{
    protected $table = 'ecommerce_user_product_membership_times';

    protected $primaryKey = 'id';

    //Local data used in setting up User Products
    public Carbon $tempStartDate;
    public Carbon $tempExpirationDate;
}
