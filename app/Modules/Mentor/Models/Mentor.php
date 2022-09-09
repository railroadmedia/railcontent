<?php

namespace App\Modules\Mentor\Models;

use App\Modules\Mentor\database\factories\MentorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\UserManagementSystem\Models\User;

/**
 * @method static \Modules\Mentor\Database\Factories\MentorFactory factory(...$parameters)
 */
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
        if ($max == 0) {
            $max = config('mentor.default_active_student_max_count');
        }
        return $this->active_student_count / $max;
    }

    protected static function newFactory()
    {
        return MentorFactory::new();
    }

}
