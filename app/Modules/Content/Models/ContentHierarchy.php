<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\Content
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $child_id
 * @property integer $child_position
 * @property Carbon $completed_on
 */
class ContentHierarchy extends Model
{
    protected $table = 'railcontent_content_hierarchy';
    public $timestamps = false;

}
