<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\SearchIndex
 *
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
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|SearchIndex newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchIndex newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchIndex query()
 * @mixin \Eloquent
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
