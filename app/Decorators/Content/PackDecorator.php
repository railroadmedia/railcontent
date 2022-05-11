<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class PackDecorator extends TypeDecoratorBase
{
    public static $skip = false;

    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'pack');

        if ($contentsOfType->isEmpty() || self::$skip) {
            return $contents;
        }

        $childCounts = $this->contentHierarchyService->countParentsChildren(
            $contents->pluck('id')
                ->toArray()
        );

        $packBundlesHierarchies = $this->contentHierarchyService->getByParentIds(
            $contents->pluck('id')
                ->toArray()
        );

        $packBundleLessonsHierarchies = $this->contentHierarchyService->getByParentIds(
            array_column($packBundlesHierarchies, 'child_id')
        );

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['url'] = url()->route('members.packs.show', [$content['slug']]);
            $contentsOfType[$contentIndex]['mobile_app_url'] =  url()->route('mobile.members.packs.show', [$content['id']]);

            $contentsOfType[$contentIndex]['xp'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_content_completed')
            );
            $contentsOfType[$contentIndex]['xp_bonus'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_content_completed')
            );

            if (($content['completed'] ?? false) !== true) {
                $contentsOfType[$contentIndex]['next_lesson_url'] =
                    url()->route('members.packs.jump-to-next-lesson', [$content['id']]);
                $contentsOfType[$contentIndex]['mobile_next_lesson_url'] =
                    url()->route('mobile.packs.jump-to-next-lesson', [$content['id']]);

            }

            $contentsOfType[$contentIndex]['bundle_count'] = $childCounts[$content['id']] ?? 0;

            foreach ($packBundlesHierarchies as $packBundlesHierarchy) {
                if ($packBundlesHierarchy['parent_id'] == $content['id']) {
                    $contentsOfType[$contentIndex]['xp'] += config('xp_ranks.pack_bundle_content_completed');

                    foreach ($packBundleLessonsHierarchies as $packBundleLessonsHierarchy) {
                        if ($packBundleLessonsHierarchy['parent_id'] == $packBundlesHierarchy['child_id']) {
                            $contentsOfType[$contentIndex]['xp'] += config('xp_ranks.difficulty_xp_map.all');
                        }
                    }
                }
            }
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
