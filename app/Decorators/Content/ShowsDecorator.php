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
    public function decorate(Collection $contents)
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

            if (!isset($contentsOfType[$contentIndex]['xp'])) {
                $contentsOfType[$contentIndex]['xp'] = 0;
            }

            if (!isset($contentsOfType[$contentIndex]['xp_bonus'])) {
                $contentsOfType[$contentIndex]['xp_bonus'] = 0;
            }

            $contentsOfType[$contentIndex]['xp'] += $content->fetch(
                'fields.xp',
                config('xp_ranks.difficulty_xp_map')[$content->fetch('fields.difficulty')]
                ??
                config('xp_ranks.difficulty_xp_map.all')
            );

            $contentsOfType[$contentIndex]['xp_bonus'] += $content->fetch(
                'fields.xp',
                config('xp_ranks.difficulty_xp_map')[$content->fetch('fields.difficulty')]
                ??
                config('xp_ranks.difficulty_xp_map.all')
            );
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
