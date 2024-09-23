<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class CoursePartDecorator extends TypeDecoratorBase
{
    public function decorate(Collection $contents): Collection
    {
        $contentsOfType = $contents->where('type', 'course-part');
        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            $exercises = [];
            $imageCount = 0;
            $exerciseCount = 0;

            // process sbt data
            foreach ($content['data'] as $contentData) {
                if ($contentData['key'] == 'sbt_image_url') {
                    $imageCount++;
                }
            }

            // process sbt data
            foreach ($content['fields'] as $contentField) {
                if ($contentField['key'] == 'sbt_exercise_number') {
                    $exerciseCount++;
                }
            }

            // process sbt data
            foreach ($content['fields'] as $contentField) {
                if ($contentField['key'] == 'sbt_exercise_number') {
                    $position = $contentField['position'];

                    if ($imageCount == $exerciseCount) {
                        $exercises[$contentField['value']][$content->fetch('fields.sbt_bpm.' . $position)] = [
                            'video_url' => $content->fetch('data.sbt_video_url.' . $position),
                            'image_url' => $content->fetch('data.sbt_image_url.' . $position),
                        ];
                    } else {
                        $exercises[$contentField['value']][$content->fetch('fields.sbt_bpm.' . $position)] = [
                            'video_url' => $content->fetch('data.sbt_video_url.' . $position),
                            'image_url' => $content->fetch('data.sbt_image_url.' . round($position / 2)),
                        ];
                    }

                }
            }

            $baseData['stbs'] = $exercises;

            $contentsOfType[$contentIndex]['stbs'] = $exercises;

        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
