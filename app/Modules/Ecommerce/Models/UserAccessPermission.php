<?php

namespace App\Modules\Ecommerce\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\Content\Models\Permission;
use App\Modules\Ecommerce\database\factories\UserAccessPermissionsFactory;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\UserManagementSystem\Models\User;

/**
 * @property int $id
 * @property integer $user_id
 * @property integer $permission_id
 * @property integer $product_id
 * @property UserAccessPermissionsSourceEnum $source
 * @property integer $source_hash
 * @property Carbon $start_time
 * @property integer $time_minutes
 * @property integer $time_days
 * @property integer $time_months
 * @property integer $time_lifetime
 * @property ?Carbon $time_fixed
 * @property UserAccessPermissionsStatusEnum $status
 * @property Carbon $revoked_at
 * @property bool $manually_revoked
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserAccessPermission extends Model
{
    use HasFactory;

    protected $table = 'user_access_permissions';

    protected $primaryKey = 'id';

    protected static function newFactory(): UserAccessPermissionsFactory
    {
        return UserAccessPermissionsFactory::new();
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function getExpirationDate(): Carbon
    {
        return $this->time_fixed ? Carbon::parse($this->time_fixed) :
            Carbon::parse($this->start_time)
            ->addMinutes($this->time_minutes)
            ->addDays($this->time_days)
            ->addMonths($this->time_months);
    }

    public function getExpirationTime(): string
    {
        if ($this->time_lifetime) {
            return 'Forever';
        }
        return $this->getExpirationDate()->toDateTimeString();
    }

    //These properties are calculated through the UserAccessPermissionsCollection determineActiveTimes method
    public ?Carbon $actualStartTime = null;
    public ?Carbon $actualExpirationTime = null;

    public function getDescription(): string
    {
        return $this->permission->name;
    }

    public function getDuration(): string
    {
        $duration = '';
        if ($this->time_lifetime) {
            $duration = 'Lifetime';
        } elseif ($this->time_fixed) {
            $duration = 'Fixed';
        } elseif ($this->time_months) {
            $duration = $this->time_months . ' Month';
            if ($this->time_months > 1) {
                $duration .= 's';
            }
        } elseif ($this->time_days) {
            $duration = $this->time_days . ' Day';
            if ($this->time_days > 1) {
                $duration .= 's';
            }
        } elseif ($this->time_minutes) {
            $duration = $this->time_minutes . ' Minute';
            if ($this->time_minutes > 1) {
                $duration .= 's';
            }
        }
        return $duration;
    }

    public function getDisplaySource(): string
    {
        switch (UserAccessPermissionsSourceEnum::tryFrom($this->source)) {
            case UserAccessPermissionsSourceEnum::Apple:
                return 'Apple Subscription';
            case UserAccessPermissionsSourceEnum::Google:
                return 'Google Subscription';
            case UserAccessPermissionsSourceEnum::Web:
                return 'Web';
            case UserAccessPermissionsSourceEnum::AccessCode:
                return 'Access Code';
            case UserAccessPermissionsSourceEnum::Challenges:
                return 'Challenge Enrollment';
            case UserAccessPermissionsSourceEnum::Migration:
                return 'Migration';
            case UserAccessPermissionsSourceEnum::Manual:
                return 'Manual';
            default:
                return 'Unknown';
        }
    }
}
