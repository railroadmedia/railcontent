<?php

namespace App\Modules\UserManagementSystem\Enums;

enum OnboardingSkillLevelEnum: int
{
    case New = 0;
    case Beginner = 1;
    case Intermediate = 2;
    case Advanced = 3;
    case Expert = 4;
}
