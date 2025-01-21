<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Content\Models\ContentPermissions
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $content_type
 * @property integer $permission_id
 * @property string $brand
 */
class ContentPermissions extends Model
{
    protected $table = 'railcontent_content_permissions';
    public $timestamps = false;

    public function permissions()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
