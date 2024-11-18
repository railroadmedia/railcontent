<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Modules\Content\Models\Content
 *
 * @property int $id
 * @property int $parent_id
 * @property int $child_id
 * @property int $child_position
 * @property Carbon $created_on
 */
class ContentHierarchy extends Model
{
    protected $table = 'railcontent_content_hierarchy';
    protected $fillable = ['child_id', 'parent_id', 'child_position', 'created_on'];
    public $timestamps = false;

    public function child(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'child_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'parent_id');
    }

    public static function createHierarchy(int $parentId, int $childId): ContentHierarchy
    {
        $hierarchy = new ContentHierarchy();
        $hierarchy->parent_id = $parentId;
        $hierarchy->child_id = $childId;
        $hierarchy->child_position = 0;
        $hierarchy->created_on = Carbon::now();
        $hierarchy->save();
        return $hierarchy;
    }
}
