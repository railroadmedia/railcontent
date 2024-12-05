<?php

namespace Modules\UserManagementSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploreTask extends Model
{
    use HasFactory;

    protected $table = 'explore_tasks';

    protected $fillable = [
        'title',
        'hook',
        'description',
        'icon',
        'expires_in_days',
        'created_at',
        'updated_at',
    ];
}
