<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class AssignmentXPDecorator extends TypeDecoratorBase
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
            if (!isset($contentsOfType[$contentIndex]['xp'])) {
                $contentsOfType[$contentIndex]['xp'] = 0;
            }
            $contentsOfType[$contentIndex]['xp'] += $content->fetch(
                'fields.xp',
                config('xp_ranks.assignment_content_completed')
            );
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
