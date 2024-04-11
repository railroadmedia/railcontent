<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;
use Railroad\Resora\Entities\Entity;

class ArtistDecorator extends ModeDecoratorBase
{
    /**
     * @param Collection $contents
     */
    public function decorate(Collection $contents)
    {
        $artists = $contents->toArray();
        foreach ($artists as $index => $content) {
            $artists[$index]['url'] = url()->route('platform.content.artist.show', [
                'brand' => brand(),
                'slug' => $content['name'] ?? '',
                'included_fields[]' => 'type,Song',
            ]);

        }

        return $artists;
    }
}
