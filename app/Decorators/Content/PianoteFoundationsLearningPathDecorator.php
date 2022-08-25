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
        $contentsOfType = $contents->where('type', 'learning-path')->where('slug', 'foundations-2019'); // todo: testing

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
                $contentsOfType[$contentIndex]['units'][$unitIndex]['lesson_count'] = count($lessons[$unit['id']]) ?? 0;
            }
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
