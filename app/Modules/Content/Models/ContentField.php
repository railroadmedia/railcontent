<?php

namespace App\Modules\Content\Models;

use App\Modules\Content\database\factories\ContentFieldFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $content_id
 * @property string $key
 * @property int $position
 * @property string $type
 * @property string $value
 */
class ContentField extends Model
{
    use HasFactory;

    protected $table = 'railcontent_content_fields';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

    protected static function newFactory(): ContentFieldFactory
    {
        return ContentFieldFactory::new();
    }
}
