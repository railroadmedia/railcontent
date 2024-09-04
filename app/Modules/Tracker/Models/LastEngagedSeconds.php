<?php

namespace App\Modules\Tracker\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $content_id
 * @property integer $resume_time_seconds
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class LastEngagedSeconds extends Model
{
    protected $table = 'railtracker_content_last_engaged_seconds';
    protected $primaryKey = 'id';

    public static function getResumeTimeSeconds(int $contentId, int $userId): int
    {
        return LastEngagedSeconds::query()
            ->where('user_id', '=', $userId)
            ->where('content_id', $contentId)->first()?->resume_time_seconds ?? 0;
    }
}
