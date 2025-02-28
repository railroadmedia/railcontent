<?php

namespace App\Modules\Content\Enums;

enum ChallengeUserProgressStatus: string
{
    case COMPLETED = 'completed';
    case NOTSTARTED = 'not_started';
    case ACTIVE = 'active';
    case INPROGRESS = 'in_progress';
}
