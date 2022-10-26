<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
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
    protected $table = 'railcontent_content_fields';
    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
