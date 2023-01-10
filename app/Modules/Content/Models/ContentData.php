<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\ContentData
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $key
 * @property int $position
 * @property string $value
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentData query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentData whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentData whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentData wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentData whereValue($value)
 * @mixin \Eloquent
 */
class ContentData extends Model
{
    protected $table = 'railcontent_content_data';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
