<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\UserPlaylistPinned
 *
 * @property integer $id
 * @property string $playlist_id
 * @property int $user_id
 * @property string $brand
 * @property Carbon $created_at
 */
class UserPlaylistPinned extends Model
{
    protected $table = 'railcontent_pinned_playlists';
    public $timestamps = false;

}
