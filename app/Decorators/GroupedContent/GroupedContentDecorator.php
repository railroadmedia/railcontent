<?php

namespace App\Decorators\GroupedContent;

use App\Decorators\Content\ModeDecoratorBase;
use App\Maps\PrimaryURLSlugToContentTypeMap;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Decorators\Decorator;

class GroupedContentDecorator extends ModeDecoratorBase
{
    protected UserContentProgressService $userContentProgressService;

    public function __construct(
        UserContentProgressService $userContentProgressService,
    ) {
        $this->userContentProgressService = $userContentProgressService;
    }
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
                    'slug' => urlencode(urlencode($content['artist'])),
                ]);
                $contents[$index]['total_plays'] = $this->userContentProgressService->countByArtistTypesUserProgress(
                    ['song'],
                    $content['artist']
                );
            } elseif ($content['type'] == 'style') {
                $lessonType =  array_flip(PrimaryURLSlugToContentTypeMap::$map)[$content['lessons'][0]['type']] ?? '';
                $contents[$index]['url'] = url()->route('platform.content.genre.show', [
                    'brand' => brand(),
                    'genre' => urlencode(urlencode($content['grouped_by_field'])),
                    'contentTypeName' => $lessonType,
                ]);
            } else {
                if(isset($content['content_type'])) {
                    $contents[$index]['url'] = url()->route('platform.content.coach.show', [
                            'brand' => brand(),
                            'firstContentSlug' => $content['slug'],
                            'firstContentId' => $content['id'],
                        ]).'?included_types[]='.$content['content_type'];
                }else{
                    //for mobile app - See All options
                    $contents[$index]['url'] = url()->route('platform.content.coach.show', [
                        'brand' => brand(),
                        'firstContentSlug' => $content['slug'],
                        'firstContentId' => $content['id'],
                    ]);
                }
            }
            $content['lessons'] = Decorator::decorate($content['lessons'], 'card');
        }

        return $contents;
    }
}
