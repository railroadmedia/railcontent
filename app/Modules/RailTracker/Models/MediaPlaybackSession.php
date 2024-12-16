<?php

namespace App\Modules\RailTracker\Models;

use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\RailTracker\database\Factories\MediaPlaybackSessionFactory;
use App\Modules\RailTracker\Enums\MediaTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
class MediaPlaybackSession extends Model
{
    use HasFactory;

    protected $table = 'railtracker_media_playback_sessions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected static function newFactory(): MediaPlaybackSessionFactory
    {
        return MediaPlaybackSessionFactory::new();
    }

    public function mediaTypeAsEnum(): MediaTypeEnum
    {
        return MediaTypeEnum::tryFrom($this->type_id) ?? MediaTypeEnum::VideoYouTube;
    }

    public function calculatePercentage(): int
    {
        return min(round($this->current_second / $this->media_length_seconds * 100), 99);
    }
}
