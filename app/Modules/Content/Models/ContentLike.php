<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\ContentLike
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $user_id
 * @property Carbon $created_on
 * @mixin \Eloquent
 */
class ContentLike extends Model
{
    protected $table = 'railcontent_content_likes';
    public $timestamps = false;
    protected $guarded = ['id'];
    private $fieldTypes = [
        'id' => 'integer',
        'created_on' => 'datetime',
        'content_id' => 'integer',
        'user_id' => 'integer',
    ];

    public static function isContentLikedByUser(int $contentId, int $userId): bool
    {
        return ContentLike::where(['content_id' => $contentId, 'user_id' => $userId])
            ->exists();
    }
}
