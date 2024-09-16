<?php

namespace App\Modules\DataVersion\Models;

use App\Modules\Content\Events\ContentLikeSaved;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Modules\Content\Models\ContentLike
 *
 * @property integer $id
 * @property integer $data_key
 * @property integer $user_id
 * @property integer $version
 * @property Carbon $updated_on
 * @property Carbon $created_on
 * @mixin \Eloquent
 */
class UserDataVersion extends Model
{
    protected $table = 'user_data_versions';
    public $timestamps = true;
}
