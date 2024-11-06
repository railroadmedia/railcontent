<?php

namespace App\Modules\RailTracker\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MediaPlaybackSessions
 *
 * @package App\Modules\RailTracker\Models
 *
 * @property int $id
 * @property string uuid
 * @property string $media_id
 * @property int $media_length_seconds
 * @property int $user_id
 * @property int $type_id
 * @property int $seconds_played
 * @property int $current_second
 * @property Carbon $started_on
 * @property Carbon $last_updated_on
 */
class MediaPlaybackSessions extends Model
{
    protected $table = 'railtracker_media_playback_sessions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function mediaPlaybackType(){
        return $this->belongsTo('MediaPlaybackType', 'type_id', 'id');
    }
}
