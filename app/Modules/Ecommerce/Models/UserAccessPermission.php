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
        return Carbon::parse($this->start_time)->addDays($this->time_days)->addMonths(
            $this->time_months
        )->toDateTimeString();
    }

    //These properties are calculated through the UserAccessPermissionsCollection determineActiveTimes method
    public ?Carbon $actualStartTime = null;
    public ?Carbon $actualExpirationTime = null;

    public function getDescription(): string
    {
        $duration = '';
        if ($this->time_lifetime) {
            $duration = 'Lifetime';
        } elseif ($this->time_days) {
            $duration = $this->time_days . ' Day';
            if ($this->time_days > 1) {
                $duration .= 's';
            }
        } elseif ($this->time_months) {
            $duration = $this->time_months . ' Month';
            if ($this->time_months > 1) {
                $duration .= 's';
            }
        }
        if ($duration) {
            return $this->permission->name . ' - ' . $duration;
        }
        return $this->permission->name;
    }

}
