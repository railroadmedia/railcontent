<?php

namespace Modules\Content\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Content\Models\ContentGenre
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $genre
 * @property int $position
 * @property-read \App\Modules\Content\Models\Content|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGenre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGenre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGenre query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGenre whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGenre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGenre wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentGenre whereTopic($value)
 * @mixin \Eloquent
 */
class ContentGenre extends Model
{
    protected $table = 'railcontent_content_genres';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
    public static function getName(): string
    {
        return 'genre';
    }
}
