<?php

namespace App\Modules\Content\Resources\Algolia\Enum;

/**
 * Types of Documents in Sanity
 *
 * DEV NOTE: these values are from the 'Legacy webhook for Algolia' Sanity webhook
 *
 * @codeCoverageIgnore
 */
enum DocumentType: string
{
    case BackstageSecret = 'backstage-secret';
    case BehindTheScenes = 'behind-the-scenes';
    case BootCamp = 'boot-camp';
    case Challenge = 'challenge';
    case CoachStream = 'coach-stream';
    case Course = 'course';
    case DiyDrumExperiment = 'diy-drum-experiment';
    case DrumFestInternational2022 = 'drum-fest-international-2022';
    case ExploringBeats = 'exploring-beats';
    case GearGuide = 'gear-guide';
    case InRhythm = 'in-rhythm';
    case LearningPath = 'learning-path';
    case LearningPathCourse = 'learning-path-course';
    case LearningPathLesson = 'learning-path-lesson';
    case LearningPathLevel = 'learning-path-level';
    case Live = 'live';
    case OnTheRoad = 'on-the-road';
    case Pack = 'pack';
    case PackBundle = 'pack-bundle';
    case PackBundleLesson = 'pack-bundle-lesson';
    case PaisteCymbals = 'paiste-cymbals';
    case Performance = 'performance';
    case PlayAlong = 'play-along';
    case PlayAlongPart = 'play-along-part';
    case Podcast = 'podcast';
    case QuestionAndAnswer = 'question-and-answer';
    case QuickTips = 'quick-tips';
    case RhythmicAdventuresOfCaptainCarson = 'rhythmic-adventures-of-captain-carson';
    case RhythmsFromAnotherPlanet = 'rhythms-from-another-planet';
    case Routine = 'routine';
    case Rudiment = 'rudiment';
    case SemesterPack = 'semester-pack';
    case SemesterPackLesson = 'semester-pack-lesson';
    case Solo = 'solo';
    case Song = 'song';
    case SongTutorial = 'song-tutorial';
    case Sonor = 'sonor';
    case Spotlight = 'spotlight';
    case StudentCollaboration = 'student-collaboration';
    case StudentFocus = 'student-focus';
    case StudyTheGreats = 'study-the-greats';
    case Tama = 'tama';
    case TheHistoryOfElectronicDrums = 'the-history-of-electronic-drums';
    case Workout = 'workout';
    case OddTimes = 'odd-times';
}
