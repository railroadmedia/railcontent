<?php

namespace App\Decorators\GroupedContent;

use App\Decorators\Content\ModeDecoratorBase;
use App\Decorators\Content\UrlDecorator;
use Railroad\Railcontent\Decorators\Entity\ContentEntityDecorator;
use Railroad\Railcontent\Support\Collection;

class GroupedContentDecorator extends ModeDecoratorBase
{

    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereIn('type', ['style', 'artist', 'instructor']);

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contents as $index => $content) {
            if ($content['type'] == 'artist') {
                $contents[$index]['url'] = url()->route('platform.content.artist.show', [
                    'brand' => brand(),
                    'slug' => $content['artist'],
                ]);
            } elseif ($content['type'] == 'style') {
                $contents[$index]['url'] = url()->route('platform.content.genre.show', [
                    'brand' => brand(),
                    'genre' => urlencode($content['grouped_by_field']),
                    'contentTypeName' => $content['content_type'],
                ]);
            } else {
                $contents[$index]['url'] = url()->route('platform.content.coach.show', [
                    'brand' => brand(),
                    'firstContentSlug' => $content['slug'],
                    'firstContentId' => $content['id'],
                ]).'?included_types[]='.$content['content_type'];
            }
        }

        return $contents;
    }
}
