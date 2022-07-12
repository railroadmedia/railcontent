<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class PackBundleDecorator extends TypeDecoratorBase
{
    public static $skip = false;

    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'pack-bundle');

        if ($contentsOfType->isEmpty() || self::$skip) {
            return $contents;
        }

        $lessons = new Collection(
            $this->contentHierarchyService->getByParentIds(
                $contentsOfType->pluck('id')
                    ->toArray()
            )
        );
        $lessonsGrouped = $lessons->groupBy('parent_id');

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['xp'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_bundle_content_completed')
            );
            $contentsOfType[$contentIndex]['xp_bonus'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_bundle_content_completed')
            );

            $contentsOfType[$contentIndex]['lesson_count'] = $content['child_count'];

            $lessonsIds = [];
            if (isset($lessonsGrouped[$content['id']])) {
                $lessonsIds =
                    $lessonsGrouped[$content['id']]->pluck('child_id')
                        ->toArray();
            }
            $lessons = $this->contentService->getByIds($lessonsIds);
            $contentsOfType[$contentIndex]['lessons'] = $lessons ?? new Collection();

            /**
             * @var $lesson ContentEntity
             */
            foreach ($lessons ?? [] as $lessonIndex => $lesson) {
                $contentsOfType[$contentIndex]['xp'] += $lesson->fetch(
                    'xp',
                    config('xp_ranks.difficulty_xp_map')[$lesson->fetch('fields.difficulty')]
                    ??
                    config('xp_ranks.difficulty_xp_map.all')
                );
            }

//            foreach (($lessons[$content['id']] ?? []) as $lessonIndex => $lesson) {
//                if ($lesson->fetch('completed') != true) {
//                    $contentsOfType[$contentIndex]['current_lesson_index'] = $lessonIndex;
//                    $contentsOfType[$contentIndex]['current_lesson'] = $lessons[$content['id']][$lessonIndex];
//                    $contentsOfType[$contentIndex]['next_lesson'] = $lessons[$content['id']][$lessonIndex + 1] ?? null;
//                    $contentsOfType[$contentIndex]['mobile_next_lesson_url'] =
//                        $lessons[$content['id']][$lessonIndex]->fetch('mobile_app_url');
//
//                    break;
//                }
//            }

        }
        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
