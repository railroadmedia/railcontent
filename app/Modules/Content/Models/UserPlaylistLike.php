<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\UserPlaylistLike
 *
 * @property integer $id
 * @property string $playlist_id
 * @property int $user_id
 * @property string $brand
 * @property Carbon $created_at
 */
class UserPlaylistLike extends Model
{
    protected $table = 'railcontent_playlist_likes';

}
