<?php

namespace Modules\Content\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\Content\Models\Content;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Content\Models\ContentLifestyle
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $lifestyle
 * @property int $position
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLifestyle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLifestyle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLifestyle query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLifestyle whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLifestyle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLifestyle wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLifestyle whereLifestyle($value)
 * @mixin \Eloquent
 */
class ContentLifestyle extends Model
{
    protected $table = 'railcontent_content_lifestyle';
    public $timestamps = false;

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
