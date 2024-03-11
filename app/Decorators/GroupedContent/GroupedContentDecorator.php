<?php

namespace App\Decorators\GroupedContent;

use App\Decorators\Content\ModeDecoratorBase;
use App\Maps\PrimaryURLSlugToContentTypeMap;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Decorators\Decorator;

class GroupedContentDecorator extends ModeDecoratorBase
{
    protected UserContentProgressService $userContentProgressService;
    protected ContentService $contentService;

    /**
     * @param UserContentProgressService $userContentProgressService
     * @param ContentService $contentService
     */
    public function __construct(UserContentProgressService $userContentProgressService, ContentService $contentService)
    {
        $this->userContentProgressService = $userContentProgressService;
        $this->contentService = $contentService;
    }

    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereIn('type', ['style', 'artist', 'instructor']);

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contents as $index => $content) {

            if ($content['type'] == 'artist') {
                $artist = $this->contentService->getWhereTypeInAndStatusAndField(['artist'],'published','name',$content['grouped_by_field'],'string')->first();
                $contents[$index]['url'] = url()->route('platform.content.artist.show', [
                    'brand' => brand(),
                    'slug' => urlencode(urlencode($content['artist'])),
                ]);
                $contents[$index]['total_plays'] = $this->userContentProgressService->countByArtistTypesUserProgress(
                    ['song'],
                    $content['artist']
                );
                $contents[$index]['data'][] = [
                    'id' => substr(md5(mt_rand()), 0, 10),
                    'content_id' => substr(md5(mt_rand()), 0, 10),
                    'key' => 'head_shot_picture_url',
                    'value' => ($artist) ?
                        $artist->fetch('data.head_shot_picture_url') :
                        config('railcontent.default_avatar_artist')[config('railcontent.brand', 'drumeo')],
                    'type' => 'string',
                    'position' => 1,
                ];
            } elseif ($content['type'] == 'style') {
                $genre = $this->contentService->getWhereTypeInAndStatusAndField(['style'],'published','name',$content['grouped_by_field'],'string')->first();
                $lessonType =  array_flip(PrimaryURLSlugToContentTypeMap::$map)[$content['lessons'][0]['type']] ?? '';
                if($content['grouped_by_field'] != ''){
                    $contents[$index]['url'] = url()->route('platform.content.genre.show', [
                        'brand' => brand(),
                        'genre' => urlencode(urlencode($content['grouped_by_field'])),
                        'contentTypeName' => $lessonType,
                    ]);
                    $contents[$index]['data'][] = [
                        'id' => substr(md5(mt_rand()), 0, 10),
                        'content_id' => substr(md5(mt_rand()), 0, 10),
                        'key' => 'head_shot_picture_url',
                        'value' => ($genre) ?
                            $genre->fetch('data.head_shot_picture_url') :
                            ( (config('railcontent.avatar_style')[$content['grouped_by_field']]) ??
                                config('railcontent.default_avatar_style')[config('railcontent.brand', 'drumeo')]
                            ),
                        'type' => 'string',
                        'position' => 1,
                    ];
                }
            } else {
                if(isset($content['content_type'])) {
                    $contents[$index]['url'] = url()->route('platform.content.coach.show', [
                            'brand' => brand(),
                            'firstContentSlug' => $content['slug'],
                            'firstContentId' => $content['id'],
                            'included_fields[]' => 'type,'.ucwords(str_replace('-',' ',$content['content_type'])),
                        'include_future_scheduled_content_only' =>false]);
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
