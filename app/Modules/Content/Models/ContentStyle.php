<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Content\Models\Content;

/**
 * Modules\Content\Models\ContentStyle
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $style
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
class ContentStyle extends Model
{
    protected $table = 'railcontent_content_styles';
    public $timestamps = false;

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
