<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $content_id
 * @property string $style
 * @property int $position
 */
class ContentStyle extends Model
{
    protected $table = 'railcontent_content_styles';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
