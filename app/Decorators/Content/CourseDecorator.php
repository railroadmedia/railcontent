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
    public function decorate(Collection $contents): Collection
    {
        // url
        $contentsOfType = $contents->where('type', 'course');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        // lesson count first and add lessons
        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['lesson_count'] = $content['child_count'] ?? 0;

        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
