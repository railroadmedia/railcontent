<?php

namespace App\Modules\Mentor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\UserManagementSystem\Models\User;

class Mentor extends Model
{
    use HasFactory;
    protected $table = 'mentors';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
