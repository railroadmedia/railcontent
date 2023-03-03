<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\Content
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $user_id
 * @property string $state
 * @property integer $progress_percent
 * @property string $higher_key_progress
 * @property Carbon $updated_on
 * @property Carbon $started_on
 * @property Carbon $completed_on
 */
class ContentUserProgress extends Model
{
    protected $table = 'railcontent_user_content_progress';
    public $timestamps = false;

}
