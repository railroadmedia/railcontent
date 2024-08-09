<?php

namespace App\Decorators\Content;

use App\Maps\ContentTypes;
use Railroad\Railcontent\Support\Collection;

class ShowsDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents): Collection
    {
        $contentsOfType = $contents->whereIn('type', config('railcontent.showTypes', [])[config('railcontent.brand')] ?? []);

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            if (!empty($content->fetch('fields.live_event_start_time'))) {
                $contentsOfType[$contentIndex]['live_event_start_time'] =
                    $content->fetch('fields.live_event_start_time');
            }

            if (!empty($content->fetch('fields.live_event_end_time'))) {
                $contentsOfType[$contentIndex]['live_event_end_time'] = $content->fetch('fields.live_event_end_time');
            }

        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
