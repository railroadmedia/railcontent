<?php

namespace App\Modules\Tracker\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $type
 * @property string $category
 */
class MediaPlaybackTypes extends Model
{
    protected $table = 'railtracker_media_playback_types';
    protected $primaryKey = 'id';


}
