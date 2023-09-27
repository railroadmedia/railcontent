<?php

namespace App\Modules\Ecommerce\Models;

use App\Modules\Content\Models\Permission;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $user_id
 * @property integer $permission_id
 * @property UserAccessPermissionsSourceEnum $source
 * @property integer $source_hash
 * @property Carbon $start_time
 * @property integer $time_days
 * @property integer $time_months
 * @property integer $time_lifetime
 * @property UserAccessPermissionsStatusEnum $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserAccessPermission extends Model
{
    protected $table = 'user_access_permissions';

    protected $primaryKey = 'id';

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function getExpirationTime(): string
    {
        if ($this->time_lifetime) {
            return 'Forever';
        }
        return Carbon::parse($this->start_time)->addDays($this->time_days)->addMonths($this->time_months)->toDateTimeString();
    }

}
