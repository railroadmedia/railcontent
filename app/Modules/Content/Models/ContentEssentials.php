<?php

namespace Modules\Content\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\Content\Models\Content;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Content\Models\ContentEssentials
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $essentials
 * @property int $position
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentEssentials newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentEssentials newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentEssentials query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentEssentials whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentEssentials whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentEssentials wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentEssentials whereEssentials($value)
 * @mixin \Eloquent
 */
class ContentEssentials extends Model
{
    protected $table = 'railcontent_content_essentials';
    public $timestamps = false;

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

    public static function getName(): string
    {
        return 'essentials';
    }
}
