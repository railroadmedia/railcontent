<?php

namespace App\Modules\Content\Models;

enum InstructorFields: string
{
    case IsCoach = 'is_coach';
    case IsCoachOfTheMonth = 'is_coach_of_the_month';
}
