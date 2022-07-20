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

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
