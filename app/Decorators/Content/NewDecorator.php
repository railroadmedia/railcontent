<?php

namespace App\Decorators\Content;

use Carbon\Carbon;
use Railroad\Railcontent\Support\Collection;

class NewDecorator extends ModeDecoratorBase
{
    public function decorate(Collection $contents)
    {
        foreach ($contents as $contentIndex => $content) {

            if (!empty($content['published_on']) &&
                Carbon::parse($content['published_on']) >
                Carbon::now()
                    ->subDays(3)) {

                $contents[$contentIndex]['is_new'] = true;
            } else {
                $contents[$contentIndex]['is_new'] = false;
            }
        }

        return $contents;
    }
}
