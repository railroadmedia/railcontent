<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\Content\database\factories\ContentFieldFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\ContentField
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $key
 * @property int $position
 * @property string $type
 * @property string $value
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \App\Modules\Content\database\factories\ContentFieldFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentField query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentField whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentField whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentField wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentField whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentField whereValue($value)
 * @mixin \Eloquent
 */
class ContentField extends Model
{
    use HasFactory;

    protected $table = 'railcontent_content_fields';
    public $timestamps = false;

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

    protected static function newFactory(): ContentFieldFactory
    {
        return ContentFieldFactory::new();
    }
}
