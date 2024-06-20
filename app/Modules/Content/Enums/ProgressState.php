<?php

namespace App\Modules\Content\Enums;

enum ProgressState: string
{
    case NotStarted = 'not started';
    case Started = 'started';
    case Completed = 'completed';
}
