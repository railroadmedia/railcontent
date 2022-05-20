<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class CourseDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        // url
        $contentsOfType = $contents->where('type', 'course');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        // everything else
        $courseIds =
            $contentsOfType->pluck('id')
                ->toArray();

        foreach ($contents as $content) {
            if (!empty($content['lessons'])) {
                $courseIds = array_diff($courseIds, [$content['id']]);
            }
        }

        $courseLessons = $this->contentService->getByParentIds($courseIds);

        // lesson count first and add lessons
        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['lesson_count'] = 0;
            $contentsOfType[$contentIndex]['duration'] = 0;
            $contentsOfType[$contentIndex]['xp'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.course_content_completed')
            );

            $contentsOfType[$contentIndex]['xp_bonus'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.course_content_completed')
            );

            foreach ($courseLessons as $courseLessonIndex => $courseLesson) {
                if ($courseLesson['parent_id'] == $content['id']) {
                    $contentsOfType[$contentIndex]['lesson_count'] += 1;
                    $contentsOfType[$contentIndex]['lessons'][] = $courseLesson;

                    $contentsOfType[$contentIndex]['duration'] = $contentsOfType[$contentIndex]['total_length_in_seconds'] =
                        ($contentsOfType[$contentIndex]['duration'] ?? 0) +
                        $courseLesson->fetch('fields.video.fields.length_in_seconds', 0);

                    $contentsOfType[$contentIndex]['xp'] += $courseLesson->fetch(
                        'xp',
                        config('xp_ranks.difficulty_xp_map')[$courseLesson->fetch('fields.difficulty')]
                        ??
                        config('xp_ranks.difficulty_xp_map.all')
                    );
                }
            }

            $currentIndex = 0;

            /**
             * @var $lesson ContentEntity
             */
            foreach (($contentsOfType[$contentIndex]['lessons'] ?? []) as $lessonIndex => $lesson) {

                if ($lesson->fetch('completed') == true) {
                    $currentIndex++;
                } else {
                    $contentsOfType[$contentIndex]['current_lesson_index'] = $currentIndex;
                    $contentsOfType[$contentIndex]['current_lesson'] =
                        $contentsOfType[$contentIndex]['lessons'][$currentIndex];
                    $contentsOfType[$contentIndex]['next_lesson'] =
                        $contentsOfType[$contentIndex]['lessons'][$currentIndex + 1] ?? null;

                    break;
                }

            }
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
