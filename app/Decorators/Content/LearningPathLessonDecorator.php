<?php

namespace App\Decorators\Content;

use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Support\Collection;

class LearningPathLessonDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
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
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
