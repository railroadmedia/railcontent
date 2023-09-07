<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $permission_id
 * @property Carbon $start_date
 * @property Carbon $expiration_date
 * @property Carbon $created_on
 * @property Carbon $updated_on
 */
class UserPermission extends Model
{
    protected $table = 'railcontent_user_permissions_permissions';
    public $timestamps = true;
}
