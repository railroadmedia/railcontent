<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class RudimentDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        // todo: impliment changes

        return $contents;
        
        $contentsOfType = $contents->where('type', 'rudiment');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['url'] =
                url()->route('members.rudiments.show', [$content['id']]);

            $contentsOfType[$contentIndex]['mobile_app_url'] =
                url()->route('mobile.content.show', $content['id']);

            $contentsOfType[$contentIndex]['musora_api_mobile_app_url'] =
                url()->route('mobile.musora-api.content.show', $content['id']);

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
