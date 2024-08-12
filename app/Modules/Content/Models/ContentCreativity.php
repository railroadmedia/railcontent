<?php

namespace Modules\Content\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\Content\Models\Content;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Content\Models\ContentCreativity
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $creativity
 * @property int $position
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentCreativity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentCreativity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentCreativity query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentCreativity whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentCreativity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentCreativity wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentCreativity whereCreativity($value)
 * @mixin \Eloquent
 */
class ContentCreativity extends Model
{
    protected $table = 'railcontent_content_creativity';
    public $timestamps = false;

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
