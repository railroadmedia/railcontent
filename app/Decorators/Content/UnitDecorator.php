<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class UnitDecorator extends TypeDecoratorBase
{

    /**
     * @param Collection $contents
     *
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'unit');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['position'] = $content['hierarchy_position_number'];
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
