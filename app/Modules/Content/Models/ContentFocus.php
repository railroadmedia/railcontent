<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\ContentFocus
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $focus
 * @property int $position
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentFocus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentFocus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentFocus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentFocus whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentFocus whereFocus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentFocus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentFocus wherePosition($value)
 * @mixin \Eloquent
 */
class ContentFocus extends Model
{
    protected $table = 'railcontent_content_focus';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
