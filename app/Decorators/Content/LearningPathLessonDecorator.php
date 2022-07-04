<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Models\Content;
use Railroad\Railcontent\Support\Collection;

class LearningPathLessonDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection|Content[] $contents
     *
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'learning-path-lesson');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['xp_bonus'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.learning_path_lesson_content_completed')
            );

            if (!empty($content->getParentContentData()[0]->position) &&
                !empty($content->getParentContentData()[1]->position)) {
                $contentsOfType[$contentIndex]['level_rank'] = $content->getParentContentData()[0]->position .
                    '.' .
                    $content->getParentContentData()[1]->position;
            }
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
