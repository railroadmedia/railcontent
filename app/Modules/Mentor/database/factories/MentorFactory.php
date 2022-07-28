<?php

namespace App\Modules\Mentor\database\factories;

use App\Modules\Mentor\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class MentorFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Mentor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'active_student_max_count' => config('mentor.default_active_student_max_count'),
            'active_student_count' => 0
        ];
    }
}
