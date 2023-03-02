<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class PlaylistItemDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return mixed|Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereNotNull('user_playlist_item_id');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            //set start/end time should not be displayed on assignments and song playlist items
            $contentsOfType[$contentIndex]['set_start_end_time'] = $content['type'] != 'assignment';
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
