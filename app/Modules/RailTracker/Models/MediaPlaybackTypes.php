<?php

namespace App\Modules\RailTracker\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MediaPlaybackTypes
 *
 * @package App\Modules\RailTracker\Models
 *
 * @property int $id
 * @property string $type
 * @property string $category
 */
class MediaPlaybackTypes extends Model
{
    protected $table = 'railtracker_media_playback_types';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['type', 'category'];
}
