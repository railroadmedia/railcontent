<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class AssignmentDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection|ContentEntity[] $contents
     * @return mixed|Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'assignment');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            $parents = $content->getParentContentData();
            if (!empty($parents)) {
                $parent = $this->contentService->getById($parents[0]->id);
                $contentsOfType[$contentIndex]['thumbnail_url'] = $parent->fetch('data.thumbnail_url');
            }
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
