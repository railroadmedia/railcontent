<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\ReportedPlaylists
 *
 * @property integer $id
 * @property string $playlist_id
 * @property int $reporter_id
 * @property Carbon $created_at
 */
class ReportedPlaylists extends Model
{
    protected $table = 'railcontent_reported_playlists';
    public $timestamps = false;
    protected $fillable = ['reporter_id', 'playlist_id', 'created_on'];


}
