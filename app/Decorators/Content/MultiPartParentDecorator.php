<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class MultiPartParentDecorator extends TypeDecoratorBase
{
    public static $off = false;

    public function decorate(Collection $contents): Collection
    {
        $contentsOfType = $contents->whereIn('type', ['course', 'song', 'unit', 'learning-path-course']);

        if ($contentsOfType->isEmpty() || self::$off) {
            return $contents;
        }

        $lessons = $this->contentService->getByParentIds(
            $contents->pluck('id')
                ->toArray()
        )
            ->groupBy('parent_id');

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['lessons'] = $lessons[$content['id']] ?? [];
            $contentsOfType[$contentIndex]['lesson_count'] = count($lessons[$content['id']] ?? []);
            $currentIndex = 0;
            $isSet = false;
            $totalLengthInSeconds = 0;

            foreach ($contentsOfType[$contentIndex]['lessons'] as $lessonIndex => $lesson) {

                $contentsOfType[$contentIndex]['lessons'][$lessonIndex]['length_in_seconds'] = $lesson->fetch('fields.video.fields.length_in_seconds', 0);

                $totalLengthInSeconds += $lesson->fetch('fields.video.fields.length_in_seconds', 0);

                if ($lesson->fetch('completed') == true) {
                    $currentIndex++;
                } else {
                    if (!$isSet) {
                        $isSet = true;
                        $contentsOfType[$contentIndex]['current_lesson_index'] = $currentIndex;
                        $contentsOfType[$contentIndex]['current_lesson'] =
                            $contentsOfType[$contentIndex]['lessons'][$currentIndex];
                        $contentsOfType[$contentIndex]['next_lesson'] =
                            $contentsOfType[$contentIndex]['lessons'][$currentIndex] ?? null;
                    }
                }
            }

            $contentsOfType[$contentIndex]['total_length_in_seconds'] =
            $contentsOfType[$contentIndex]['length_in_seconds'] = $totalLengthInSeconds;

            if (($contentsOfType[$contentIndex]['lesson_count'] == 1) &&
                ($contentsOfType[$contentIndex]['type'] == 'song')) {
                $contentsOfType[$contentIndex]['song_part_id'] = $contentsOfType[$contentIndex]['lessons'][0]['id'];
            }
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
