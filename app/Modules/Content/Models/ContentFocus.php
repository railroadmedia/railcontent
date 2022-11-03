<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $content_id
 * @property string $focus
 * @property int $position
 */
class ContentFocus extends Model
{
    protected $table = 'railcontent_content_focus';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
