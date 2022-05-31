<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class SemesterPackLessonDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'semester-pack-lesson');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        $parents = $this->contentService->getByChildIdsWhereTypeForUrl(
            $contentsOfType->pluck('id')
                ->toArray(),
            'semester-pack'
        );

        foreach ($contentsOfType as $contentIndex => $content) {
            foreach ($parents as $parent) {
                if (in_array($content['id'], $parent['child_ids'])) {

                    // get instructor from parent if its empty
                    if (empty($contentsOfType[$contentIndex]->fetch('fields.instructor'))) {
                        foreach ($parent['fields'] as $field) {
                            if ($field['key'] == 'instructor') {
                                $contentsOfType[$contentIndex]['fields'][] = $field;
                                $contentsOfType[$contentIndex] = new ContentEntity($contentsOfType[$contentIndex]->getArrayCopy());
                            }
                        }
                    }
                }
            }

            $contentsOfType[$contentIndex]['week'] = $content->fetch('fields.week');

            if (!isset($contentsOfType[$contentIndex]['xp'])) {
                $contentsOfType[$contentIndex]['xp'] = 0;
            }

            if (!isset($contentsOfType[$contentIndex]['xp_bonus'])) {
                $contentsOfType[$contentIndex]['xp_bonus'] = 0;
            }

            $contentsOfType[$contentIndex]['xp'] += $content->fetch(
                'fields.xp',
                config('xp_ranks.difficulty_xp_map')[$content->fetch('fields.difficulty')]
                ??
                config('xp_ranks.difficulty_xp_map.all')
            );

            $contentsOfType[$contentIndex]['xp_bonus'] += $content->fetch(
                'fields.xp',
                config('xp_ranks.difficulty_xp_map')[$content->fetch('fields.difficulty')]
                ??
                config('xp_ranks.difficulty_xp_map.all')
            );
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
