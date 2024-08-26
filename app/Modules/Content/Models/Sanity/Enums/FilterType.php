<?php

namespace App\Modules\Content\Models\Sanity\Enums;

use App\Modules\Content\Models\Sanity\Challenge;
use App\Modules\Content\Models\Sanity\Course;
use App\Modules\Content\Models\Sanity\Instructor;
use App\Modules\Content\Models\Sanity\PlayAlong;
use App\Modules\Content\Models\Sanity\QuickTip;
use App\Modules\Content\Models\Sanity\Rudiment;
use App\Modules\Content\Models\Sanity\Shows\Archive;
use App\Modules\Content\Models\Sanity\Shows\BootCamp;
use App\Modules\Content\Models\Sanity\Shows\Challenges;
use App\Modules\Content\Models\Sanity\Shows\GearGuide;
use App\Modules\Content\Models\Sanity\Shows\Live;
use App\Modules\Content\Models\Sanity\Shows\Performance;
use App\Modules\Content\Models\Sanity\Shows\Podcast;
use App\Modules\Content\Models\Sanity\Shows\QuestionAndAnswer;
use App\Modules\Content\Models\Sanity\Shows\Solo;
use App\Modules\Content\Models\Sanity\Shows\Spotlight;
use App\Modules\Content\Models\Sanity\Song;
use App\Modules\Content\Models\Sanity\SongTutorial;
use App\Modules\Content\Models\Sanity\StudentFocus;
use App\Modules\Content\Models\Sanity\Workout;

/**
 * Video Types supported
 */
enum FilterType: string
{
    case Genre = 'genre';
    case Lifestyle = 'lifestyle';
    case Essential = 'essential';
    case Creativity = 'creativity';
    case Theory = 'theory';
    case Topic = 'topic';
    case Gear = 'gear';

    public function filterOptions(): array
    {
        return match ($this) {
            FilterType::Genre => [Instructor::getName(),
                Course::getName(), StudentFocus::getName(), Rudiment::getName(), GearGuide::getName(),
                Challenges::getName(), BootCamp::getName(), QuickTip::getName(), Live::getName(), Solo::getName(), Performance::getName(),
                QuestionAndAnswer::getName(), PlayAlong::getName(), BootCamp::getName(), Podcast::getName(), SongTutorial::getName(), Archive::getName(),
                Song::getName()],
            FilterType::Lifestyle => [Instructor::getName(), Course::getName(), StudentFocus::getName(),QuickTip::getName()],
            FilterType::Essential => [Instructor::getName(), Course::getName(), StudentFocus::getName(),QuickTip::getName(), Rudiment::getName(),Spotlight::getName(),
                BootCamp::getName(), Live::getName(), QuestionAndAnswer::getName(), PlayAlong::getName()],
            FilterType::Creativity => [Instructor::getName(), Course::getName(),StudentFocus::getName(),QuickTip::getName()],
            FilterType::Theory => [Instructor::getName(), Course::getName(), StudentFocus::getName(), QuickTip::getName(),Live::getName(), QuestionAndAnswer::getName(), PlayAlong::getName()],
            FilterType::Topic => [Course::getName(), StudentFocus::getName(),Rudiment::getName(),BootCamp::getName(),QuickTip::getName(),Challenge::getName(), Workout::getName()],
            FilterType::Gear => [Rudiment::getName()],
        };
    }
}
