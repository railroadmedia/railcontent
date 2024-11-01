<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property string $content_name
 * @property string $playlist_item_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserPlaylistContent extends Model
{
    protected $table = 'railcontent_user_playlist_content';
    protected $fillable = ['start_second', 'end_second', 'playlist_item_name'];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
    public function playlist(): BelongsTo
    {
        return $this->belongsTo(UserPlaylist::class, 'user_playlist_id');
    }

    public function deletePlaylistItemAndReposition()
    {
        // Adjust positions for items with higher positions
        self::where('user_playlist_id', $this->user_playlist_id)
            ->where('position', '>', $this["position"])
            ->decrement('position');

        // Delete the specific item
        $deleted = $this->delete();

        return $deleted > 0;
    }

}
