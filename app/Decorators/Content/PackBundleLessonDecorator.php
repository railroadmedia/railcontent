<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class PackBundleLessonDecorator extends TypeDecoratorBase
{
    public function decorate(Collection $contents): Collection
    {
        $contentsOfType = $contents->where('type', 'pack-bundle-lesson');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {

            $exercises = [];

            // process sbt data
            foreach ($content['fields'] as $contentField) {
                if ($contentField['key'] == 'sbt_exercise_number') {
                    $position = $contentField['position'];

                    $exercises[$contentField['value']][$content->fetch('fields.sbt_bpm.' . $position)] = [
                        'video_url' => $content->fetch('data.sbt_video_url.' . $position),
                        'image_url' => $content->fetch('data.sbt_image_url.' . $position),
                    ];
                }
            }

            $contentsOfType[$contentIndex]['stbs'] = $exercises;

            $bdsExercises = [];

            // process sbt data
            foreach ($content['data'] as $contentDatum) {
                if ($contentDatum['key'] == 'smart_beat_fast_bpm_mp3_url') {
                    $position = $contentDatum['position'];

                    $bdsExercises[$contentDatum['position']] = [
                        'fast_mp3_url' => $content->fetch('data.smart_beat_fast_bpm_mp3_url.' . $position),
                        'slow_mp3_url' => $content->fetch('data.smart_beat_slow_bpm_mp3_url.' . $position),
                        'image_url' => $content->fetch(
                            'data.smart_beat_sheet_music_image_url.' . ($position + 1)
                        ),
                    ];
                }
            }

            $contentsOfType[$contentIndex]['bdsStbs'] = $bdsExercises;

            $ds2Exercises = [];

            // process sbt data
            foreach ($content['fields'] as $contentField) {
                if ($contentField['key'] == 'sbt_exercise_number') {
                    $position = $contentField['position'];

                    $ds2Exercises[$contentField['value']] = [
                        'fast_mp3_url' => $content->fetch('data.sbt_fast_mp3_url.' . $position),
                        'slow_mp3_url' => $content->fetch('data.sbt_slow_mp3_url.' . $position),
                        'image_url' => $content->fetch('data.sbt_image_url.' . $position),
                    ];
                }
            }

            $contentsOfType[$contentIndex]['ds2Stbs'] = $ds2Exercises;
            $contentsOfType[$contentIndex]['lesson_count'] = $content['child_count'];
        }
        return $this->mergeDecorated($contents, $contentsOfType);

    }
}
