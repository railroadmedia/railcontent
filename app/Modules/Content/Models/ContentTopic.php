<?php

namespace Modules\Content\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Content\Models\ContentTopic
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $topic
 * @property int $position
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTopic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTopic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTopic query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTopic whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTopic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTopic wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentTopic whereTopic($value)
 * @mixin \Eloquent
 */
class ContentTopic extends Model
{
    protected $table = 'railcontent_content_topics';
    public $timestamps = false;

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
