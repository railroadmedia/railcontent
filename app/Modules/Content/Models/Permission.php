<?php

namespace App\Modules\Content\Models;

use App\Modules\Content\Builders\ContentBuilder;
use App\Modules\Content\database\factories\PermissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'railcontent_permissions';
    public $timestamps = false;

    public function newEloquentBuilder($query): ContentBuilder
    {
        return new ContentBuilder($query);
    }

    protected static function newFactory()
    {
        return PermissionFactory::new();
    }
}
