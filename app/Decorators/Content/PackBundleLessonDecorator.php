<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class PackBundleLessonDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'pack-bundle-lesson');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        PackBundleDecorator::$skip = true;
        PackDecorator::$skip = true;

        $parents = $this->contentService->getByChildIdsWhereType(
            $contentsOfType->pluck('id')
                ->toArray(),
            'pack-bundle'
        );

        $parentParents = $this->contentService->getByChildIdsWhereType(
            $parents->pluck('id')
                ->toArray(),
            'pack'
        );

        foreach ($contentsOfType as $contentIndex => $content) {
            foreach ($parents as $parent) {
                if (in_array($content['id'], $parent['child_ids'])) {

                    foreach ($parentParents as $parentParent) {
                        if (in_array($parent['id'], $parentParent['child_ids'])) {

                            if ($parentParent['slug'] == 'piano-technique-made-easy' ||
                                $parentParent['slug'] == 'de-stupefy-your-left-hand' ||
                                $parentParent['slug'] == 'victoria-theodore-teaches-classical-piano') {
                            } else {

                            }

                            if (!empty($content['resources']) || !empty($parent['resources']??[]) || !empty($parentParent['resources']??[])) {
                                $contentsOfType[$contentIndex]['resources'] = array_merge(
                                    $contentsOfType[$contentIndex]['resources'] ?? [],
                                    $parent['resources'] ?? [],
                                    $parentParent['resources'] ?? []
                                );
                            }
                        }
                    }

                }
            }
        }

        PackBundleDecorator::$skip = false;

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
