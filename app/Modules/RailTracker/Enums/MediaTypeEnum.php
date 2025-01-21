<?php

namespace App\Modules\RailTracker\Enums;

use InvalidArgumentException;

enum MediaTypeEnum: int
{
    case VideoYouTube = 1;
    case VideoVimeo = 2;
    case SoundSliceAssignment = 3;
    case PlayAlong = 4;

    public static function fromTypeCategory(string $mediaType, string $mediaCategory): MediaTypeEnum
    {
        return match ($mediaType . '_' . $mediaCategory) {
            'video_youtube' => MediaTypeEnum::VideoYouTube,
            'video_vimeo' => MediaTypeEnum::VideoVimeo,
            'assignment_soundslice' => MediaTypeEnum::SoundSliceAssignment,
            'practice_play-alongs' => MediaTypeEnum::PlayAlong,
            default => throw new InvalidArgumentException("Unsupported media type: $mediaType"),
        };
    }
}
