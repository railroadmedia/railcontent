<?php

namespace App\Decorators\Content;

use App\Maps\ContentTypes;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Support\Collection;

class ContentExperienceDecorator extends TypeDecoratorBase
{
    public static $skip = false;

    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM || self::$skip) {
            return $contents;
        }

        if ($contents->isEmpty()) {
            return $contents;
        }

        foreach ($contents as $contentIndex => $content) {

            // assignments
            if (in_array($content['type'], ['assignment'])) {

                $contents[$contentIndex]['xp'] = $content->fetch(
                    'fields.xp',
                    config('xp_ranks.assignment_content_completed')
                );

                $contents[$contentIndex]['xp_bonus'] = $content->fetch(
                    'fields.xp',
                    config('xp_ranks.assignment_content_completed')
                );
            }

            // singular lesson types, they use difficulty unless otherwise set in the CMS
            if (in_array($content['type'], ContentTypes::singularContentTypes())) {

                $defaultPointAmount = config('xp_ranks.difficulty_xp_map')[$content->fetch('fields.difficulty')]
                    ??
                    config('xp_ranks.difficulty_xp_map.all');

                $pointAmount = $content->fetch('fields.xp', $defaultPointAmount);

                if (!is_int($pointAmount)) {
                    $contentID = $content['id'];
                    Log::warning("Content $contentID XP field is set to '$pointAmount' and is not an integer.");
                    $pointAmount = $defaultPointAmount;
                }

                foreach ($content['assignments'] ?? [] as $assignment) {
                    $pointAmount += (int)$assignment->fetch('xp', 0);
                }
                $contents[$contentIndex]['xp'] = $pointAmount;
                $contents[$contentIndex]['xp_bonus'] = $pointAmount;
            }

            // units
            if (in_array($content['type'], ['unit'])) {

                $pointAmount = 0;

                foreach ($content['lessons'] ?? [] as $lesson) {
                    $pointAmount += $lesson['xp'] ?? 0;
                }

                $pointAmount += $content->fetch(
                    'fields.xp',
                    config('xp_ranks.unit_content_completed')
                );

                $contents[$contentIndex]['xp'] = $pointAmount;

                $contents[$contentIndex]['xp_bonus'] = $content->fetch(
                    'fields.xp',
                    $content->fetch(
                        'fields.xp',
                        config('xp_ranks.unit_content_completed')
                    )
                );
            }

            // course
            if (in_array($content['type'], ['course'])) {

                $pointAmount = 0;

                foreach ($content['lessons'] ?? [] as $lesson) {
                    $pointAmount += $lesson['xp'] ?? 0;
                }

                $pointAmount += $content->fetch(
                    'fields.xp',
                    config('xp_ranks.course_content_completed')
                );

                $contents[$contentIndex]['xp'] = $pointAmount;

                $contents[$contentIndex]['xp_bonus'] = $content->fetch(
                    'fields.xp',
                    $content->fetch(
                        'fields.xp',
                        config('xp_ranks.course_content_completed')
                    )
                );
            }

            // song
            if (in_array($content['type'], ['song'])) {

                $pointAmount = 0;

                foreach ($content['lessons'] ?? [] as $lesson) {
                    $pointAmount += $lesson['xp'] ?? 0;
                }

                $pointAmount += $content->fetch(
                    'fields.xp',
                    config('xp_ranks.song_content_completed')
                );

                $contents[$contentIndex]['xp'] = $pointAmount;

                $contents[$contentIndex]['xp_bonus'] = $content->fetch(
                    'fields.xp',
                    $content->fetch(
                        'fields.xp',
                        config('xp_ranks.song_content_completed')
                    )
                );
            }

            // learning path
            if (in_array($content['type'], ['learning-path'])) {

                $pointAmount = 0;

                foreach ($content['units'] ?? [] as $unit) {
                    $pointAmount += $unit['xp'] ?? 0;
                }

                $pointAmount += $content->fetch(
                    'fields.xp',
                    config('xp_ranks.learning_path_content_completed')
                );

                $contents[$contentIndex]['xp'] = $pointAmount;

                $contents[$contentIndex]['xp_bonus'] = $content->fetch(
                    'fields.xp',
                    $content->fetch(
                        'fields.xp',
                        config('xp_ranks.learning_path_content_completed')
                    )
                );
            }
        }

        return $contents;
    }
}
