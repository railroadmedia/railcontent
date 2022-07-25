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

    public function getActiveStudentPercentage(): float
    {
        $max = $this->active_student_max_count;
        if ($max == 0) $max = config('default_active_student_max_count');
        return $this->active_student_count / $max;
    }


}
