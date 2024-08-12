<?php

namespace App\Decorators\GroupedContent;

use App\Decorators\Content\ModeDecoratorBase;
use App\Maps\PrimaryURLSlugToContentTypeMap;
use Railroad\Railcontent\Services\ArtistService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\GenreService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Decorators\Decorator;
use Illuminate\Support\Facades\Log;

class GroupedContentDecorator extends ModeDecoratorBase
{
    protected UserContentProgressService $userContentProgressService;
    protected ContentService $contentService;
    protected ArtistService $artistService;
    protected GenreService $genreService;

    public function __construct(
        UserContentProgressService $userContentProgressService,
        ContentService $contentService,
        ArtistService $artistService,
        GenreService $genreService
    ) {
        $this->userContentProgressService = $userContentProgressService;
        $this->contentService = $contentService;
        $this->artistService = $artistService;
        $this->genreService = $genreService;
    }

    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereIn('type', ['style', 'artist', 'instructor', 'recommended']);

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contents as $index => $content) {
            if ($content['type'] == 'artist') {
                $artist = $this->artistService->getByName($content['grouped_by_field']);
                $artistSlug = encodeURI($content['artist']);
                $lessonType = $content['lessons'][0]['type'] ?? '';
                $contents[$index]['url'] = url()->route('platform.content.artist.show', [
                    'brand' => brand(),
                    'slug' => $artistSlug,
                    'included_fields[]' => 'type,'.ucwords(str_replace('-', ' ', $lessonType)),
                ]);
                $contents[$index]['total_plays'] = $this->userContentProgressService->countByArtistTypesUserProgress(
                    ['song'],
                    $content['artist']
                );
                $contents[$index]['data'][] = [
                    'id' => substr(md5(mt_rand()), 0, 10),
                    'content_id' => substr(md5(mt_rand()), 0, 10),
                    'key' => 'head_shot_picture_url',
                    'value' => ($artist) ? $artist['head_shot_picture_url'] :
                        config('railcontent.default_avatar_artist')[config('railcontent.brand', 'drumeo')],
                    'type' => 'string',
                    'position' => 1,
                ];
            } elseif ($content['type'] == 'style') {
                $genre = $this->genreService->getByName($content['grouped_by_field']);
                $lessonType = array_flip(PrimaryURLSlugToContentTypeMap::$map)[$content['lessons'][0]['type']] ?? '';
                if ($content['grouped_by_field'] != '') {
                    $genreUrl = encodeURI($content['grouped_by_field']);
                    $contents[$index]['url'] = url()->route('platform.content.genre.show', [
                        'brand' => brand(),
                        'genre' => $genreUrl,
                        'contentTypeName' => $lessonType,
                    ]);
                    $contents[$index]['data'][] = [
                        'id' => substr(md5(mt_rand()), 0, 10),
                        'content_id' => substr(md5(mt_rand()), 0, 10),
                        'key' => 'head_shot_picture_url',
                        'value' => ($genre) ? $genre['head_shot_picture_url'] :
                            config('railcontent.default_avatar_style')[config('railcontent.brand', 'drumeo')],
                        'type' => 'string',
                        'position' => 1,
                    ];
                }
            } else {
                if ($content['type'] == 'recommended') {
                    $id = strtolower($content['id']);
                    $filter = match (true) {
                        str_contains($id, 'song') => 'song',
                        str_contains($id, 'lesson') => 'lesson',
                        default => ''
                    };
                    if ($filter) {
                        $content['url'] = url()->route('platform.recommended-lessons', [
                            'brand' => brand(),
                            'tabs[]' => "filter,$filter",
                        ]);
                    }
                } else {
                    if (isset($content['content_type'])) {
                        $contents[$index]['url'] = url()->route('platform.content.coach.show', [
                            'brand' => brand(),
                            'firstContentSlug' => $content['slug'],
                            'firstContentId' => $content['id'],
                            'included_fields[]' => 'type,'.ucwords(str_replace('-', ' ', $content['content_type'])),
                            'include_future_scheduled_content_only' => false,
                        ]);
                    } else {
                        //for mobile app - See All options
                        $contents[$index]['url'] = url()->route('platform.content.coach.show', [
                            'brand' => brand(),
                            'firstContentSlug' => $content['slug'],
                            'firstContentId' => $content['id'],
                        ]);
                    }
                }
            }
            $content['lessons'] = Decorator::decorate($content['lessons'], 'card');
        }

        return $contents;
    }
}
