<?php

namespace App\Decorators\Content;

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
            if($content['type'] == 'pack-bundle-lesson' && isset(($contents[$contentIndex]['chapters']))){
                foreach($contents[$contentIndex]['chapters'] as $index=>$chapter){
                    // We've only uploaded 20 default images chapters to amazon
                    if($index <= 19) {
                        $position                                                             = $index + 1;
                        $contents[$contentIndex]['chapters'][$index]['chapter_thumbnail_url'] = $contents[$contentIndex]['chapters'][$index]['chapter_thumbnail_url'] ??
                            'https://musora-web-platform.s3.amazonaws.com/chapters/' . $content['brand'] . '/Chapter' . $position . '.jpg';
                    }
                }
            }
        }

        return $contents;
    }
}
