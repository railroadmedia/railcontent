<?php

namespace Modules\Content\Models;

use App\Modules\Content\Models\Content;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Content\Models\ContentGears
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $gear
 * @property int $position
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGears newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGears newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGears query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGears whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGears whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGears wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGears whereGear($value)
 * @mixin \Eloquent
 */
class ContentGears extends Model
{
    protected $table = 'railcontent_content_gears';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
