<?php

namespace App\Modules\Mentor\Services;

enum EnsureMentorResult: int
{
    case NoChange = 0;
    case MentorAssigned = 1;
}
