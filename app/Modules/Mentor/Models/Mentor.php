<?php

namespace App\Modules\Mentor\Models;

use App\Modules\Mentor\database\factories\MentorFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\UserManagementSystem\Models\User;

/**
 * Class Mentor
 *
 * @internal
 * @package App\Modules\Mentor\Models
 * @property integer $id
 * @property integer $user_id
 * @property string $supported_brands
 * @property integer $active_student_max_count
 * @property integer $active_student_count
 * @property integer $total_student_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $user
 * @method static \App\Modules\Mentor\database\factories\MentorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereActiveStudentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereActiveStudentMaxCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereSupportedBrands($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereTotalStudentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereUserId($value)
 * @mixin \Eloquent
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

    protected static function newFactory(): MentorFactory
    {
        return MentorFactory::new();
    }

}
