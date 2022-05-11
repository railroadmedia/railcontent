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

        $parents = $this->contentService->getByChildIdsWhereType(
            $contentsOfType->pluck('id')
                ->toArray(),
            'pack'
        );

        $childCounts = $this->contentHierarchyService->countParentsChildren(
            $contents->pluck('id')
                ->toArray()
        );

        $lessons = $this->contentService->getByParentIds(
            $contentsOfType->pluck('id')
                ->toArray()
        )
            ->groupBy('parent_id');

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['xp'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_bundle_content_completed')
            );
            $contentsOfType[$contentIndex]['xp_bonus'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_bundle_content_completed')
            );
            $contentsOfType[$contentIndex]['url'] = url()->route('members.packs.bundle', [$parents[0]['slug'], $content['slug'], $content['id']]);
            $contentsOfType[$contentIndex]['mobile_app_url'] =  url()->route('mobile.members.packs.show', [$content['id']]);
            foreach ($parents as $parent) {
                if (in_array($content['id'], $parent['child_ids'])) {
//                    $contentsOfType[$contentIndex]['url'] =
//                        url()->route('members.packs.show', ["slug" => $parent['slug']]);

                    $contentsOfType[$contentIndex]['lesson_count'] = $childCounts[$content['id']] ?? 0;
                }
            }

            $contentsOfType[$contentIndex]['lessons'] = $lessons[$content['id']] ?? new Collection();

            /**
             * @var $lesson ContentEntity
             */
            foreach (($lessons[$content['id']] ?? []) as $lessonIndex => $lesson) {
                $contentsOfType[$contentIndex]['xp'] += $lesson->fetch(
                    'xp',
                    config('xp_ranks.difficulty_xp_map')[$lesson->fetch('fields.difficulty')]
                    ??
                    config('xp_ranks.difficulty_xp_map.all')
                );
            }

            foreach (($lessons[$content['id']] ?? []) as $lessonIndex => $lesson) {
                if ($lesson->fetch('completed') != true) {
                    $contentsOfType[$contentIndex]['current_lesson_index'] = $lessonIndex;
                    $contentsOfType[$contentIndex]['current_lesson'] = $lessons[$content['id']][$lessonIndex];
                    $contentsOfType[$contentIndex]['next_lesson'] = $lessons[$content['id']][$lessonIndex + 1] ?? null;
                    $contentsOfType[$contentIndex]['mobile_next_lesson_url'] = $lessons[$content['id']][$lessonIndex]->fetch('mobile_app_url');

                    break;
                }

            }

        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
