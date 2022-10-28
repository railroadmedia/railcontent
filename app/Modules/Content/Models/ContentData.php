<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $content_id
 * @property string $key
 * @property int $position
 * @property string $value
 */
class ContentData extends Model
{
    protected $table = 'railcontent_content_data';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
