<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $content_id
 * @property string $high_value
 * @property string $medium_value
 * @property string $low_value
 * @property string $brand
 * @property string $content_type
 * @property string $content_status
 * @property string $content_instructors
 * @property Carbon $content_published_on
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SearchIndex extends Model
{
    protected $table = 'railcontent_search_indexes_staging';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
