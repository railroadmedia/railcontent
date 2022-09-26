<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class SongsDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'song');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['lesson_count'] = $content['child_count'];
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
