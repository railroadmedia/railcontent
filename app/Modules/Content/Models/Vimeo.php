<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\Vimeo
 *
 * @property integer $id
 * @property string $video_poster_image_url
 * @property string $hlsManifestUrl
 * @property string $external_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Vimeo extends Model
{
    protected $table = 'vimeo';

    protected $fillable = ['external_id', 'video_playback_endpoints', 'video_poster_image_url','hlsManifestUrl','length_in_seconds'];
}
