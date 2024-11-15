<?php

namespace App\Modules\Content\Resources\Algolia\Enum;

/**
 * Indexes defined in Algolia that we use.
 * These are in Algolia, prepended with an environment;
 * e.g. production_sanity_all and staging_sanity_all, where the environment corresponds to the dataset used
 */
enum Index: string
{
    case All = 'sanity_all';
    case Pack = 'sanity_pack';
    case Workout = 'sanity_workout';
    case StudentFocus = 'sanity_student-focus';
    case SongTutorial = 'sanity_song-tutorial';
    case Song = 'sanity_song';
    case Rudiment = 'sanity_rudiment';
    case Routine = 'sanity_routine';
    case QuickTips = 'sanity_quick-tips';
    case Podcast = 'sanity_podcast';
    case PlayAlong = 'sanity_play-along';
    case Course = 'sanity_course';
    case Bootcamp = 'sanity_boot-camp';

    public function valueForEnvironment(): string
    {
        return sprintf('%s_%s', config('algolia.environment'), $this->value);
    }
}
