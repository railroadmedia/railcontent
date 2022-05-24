<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Support\Collection;

class PianoteFoundationsLearningPathDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'learning-path')->where('slug', 'foundations'); // todo: testing

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        $old = ContentRepository::$pullFutureContent;

        ContentRepository::$pullFutureContent = true;

        $units = $this->contentService->getByParentIds(
            $contentsOfType->pluck('id')
                ->toArray()
        );

        ContentRepository::$pullFutureContent = $old;

        $unitsGrouped = $units->groupBy('parent_id');

        $lessons = $this->contentService->getByParentIds(
            $units->pluck('id')
                ->toArray()
        )
            ->groupBy('parent_id');

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['units'] = $unitsGrouped[$content['id']] ?? [];

            foreach ($contentsOfType[$contentIndex]['units'] as $unitIndex => $unit) {
                $contentsOfType[$contentIndex]['units'][$unitIndex]['lessons'] = $lessons[$unit['id']] ?? [];

                if ($unit->fetch('completed') == true) {
                    continue;
                }

                $contentsOfType[$contentIndex]['next_unit'] = $unit;

                $currentIndex = 0;

                foreach ($contentsOfType[$contentIndex]['units'][$unitIndex]['lessons'] as $lessonIndex => $lesson) {

                    if ($lesson->fetch('completed') == true) {
                        $currentIndex++;
                    } else {
                        $contentsOfType[$contentIndex]['current_lesson_index'] = $currentIndex;
                        $contentsOfType[$contentIndex]['current_lesson'] =
                            $contentsOfType[$contentIndex]['units'][$unitIndex]['lessons'][$currentIndex] ?? null;
                        $contentsOfType[$contentIndex]['next_lesson'] =
                            $contentsOfType[$contentIndex]['units'][$unitIndex]['lessons'][$currentIndex] ?? null;

                        break;
                    }

                }

                if (empty($contentsOfType[$contentIndex]['current_lesson']) &&
                    !empty($contentsOfType[$contentIndex]['units'][$unitIndex]['lessons'][0])) {
                    $contentsOfType[$contentIndex]['current_lesson'] =
                        $contentsOfType[$contentIndex]['units'][$unitIndex]['lessons'][0] ?? null;
                }

                break;
            }
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
