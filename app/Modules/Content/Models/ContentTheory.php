<?php

namespace Modules\Content\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\Content\Models\Content;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Content\Models\ContentTheory
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $theory
 * @property int $position
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTheory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTheory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTheory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTheory whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTheory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTheory wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTheory whereTheory($value)
 * @mixin \Eloquent
 */
class ContentTheory extends Model
{
    protected $table = 'railcontent_content_theory';
    public $timestamps = false;

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
    public static function getName(): string
    {
        return 'theory';
    }
}
