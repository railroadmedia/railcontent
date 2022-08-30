<?php

namespace App\Modules\Mentor\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\UserManagementSystem\Models\User;

/**
 * Class MentorStudent
 * @internal
 *
 * @package App\Modules\Mentor\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property boolean $active
 * @property string $primary_brand
 * @property integer $mentor_user_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class MentorStudent extends Model
{
    use HasFactory;

    protected $table = 'mentor_students';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
