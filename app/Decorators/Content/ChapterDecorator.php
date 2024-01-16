<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Support\Collection;

class ChapterDecorator extends ModeDecoratorBase
{
    public function decorate(Collection $contents)
    {
        foreach ($contents as $contentIndex => $content) {
            foreach ($content['data'] ?? [] as $datum) {
                if ($datum['key'] === 'chapter_timecode') {
                    $contents[$contentIndex]['chapters'][$datum['position'] - 1]['chapter_timecode'] = $datum['value'];
                }

                if ($datum['key'] === 'chapter_description') {
                    $contents[$contentIndex]['chapters'][$datum['position'] - 1]['chapter_description'] =
                        $datum['value'];
                }

                if ($datum['key'] === 'chapter_thumbnail_url') {
                    $contents[$contentIndex]['chapters'][$datum['position'] - 1]['chapter_thumbnail_url'] =
                        $datum['value'];
                }
            }
        }

        return $contents;
    }
}
