<?php

namespace App\Modules\Mentor\database\factories;

use App\Modules\Mentor\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagementSystem\Models\User;

class MentorFactory extends Factory
{
    protected $model = Mentor::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'active_student_max_count' => config('mentor.default_active_student_max_count'),
            'active_student_count' => 0
        ];
    }

}
