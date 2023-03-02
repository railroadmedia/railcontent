<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Support\Collection;

class PlaylistItemDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
//        dd($contents);
        // url
        $contentsOfType = $contents->whereNotNull('user_playlist_item_id');
//
        if ($contentsOfType->isEmpty()) {
//            dd($contentsOfType);
            return $contents;
        }
//
//        // lesson count first and add lessons
        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['set_start_end_time'] = $content['type'] != 'assignment';

        }
//
        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
