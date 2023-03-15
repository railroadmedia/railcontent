<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\UserPlaylist
 *
 * @property integer $id
 * @property string $brand
 * @property string $type
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $thumbnail_url
 * @property string $category
 * @property int $private
 * @property int $duration
 * @property Carbon $last_progress
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserPlaylist extends Model
{
    protected $table = 'railcontent_user_playlists';

}
