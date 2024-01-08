<?php

namespace Modules\Content\Models;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentStyle;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\ContentEssentials
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $essentials
 * @property int $position
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentStyle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentStyle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentStyle query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentStyle whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentStyle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentStyle wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentStyle whereStyle($value)
 * @mixin \Eloquent
 */
class ContentEssentials extends Model
{
    protected $table = 'railcontent_content_essentials';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
