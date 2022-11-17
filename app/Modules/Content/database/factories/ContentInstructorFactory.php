<?php

namespace App\Modules\Content\database\factories;

use App\Modules\Content\Models\ContentInstructor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentInstructorFactory extends Factory
{
    protected $model = ContentInstructor::class;

    public function definition(): array
    {
        return [
            'position' => 1
        ];
    }
}
