<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\UserPlaylist
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $user_playlist_id
 * @property integer $position
 * @property string $extra_data
 * @property integer $start_second
 * @property integer $end_second
 * @property integer $parent_id
 * @property Carbon $last_progress
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserPlaylistContent extends Model
{
    protected $table = 'railcontent_user_playlist_content';

}
