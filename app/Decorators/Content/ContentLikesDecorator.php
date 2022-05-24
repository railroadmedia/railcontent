<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Services\ContentLikeService;
use Railroad\Railcontent\Support\Collection;

class ContentLikesDecorator extends ModeDecoratorBase
{
    /**
     * @var ContentLikeService
     */
    private $contentLikeService;

    /**
     * ContentLikesDecorator constructor.
     */
    public function __construct(ContentLikeService $contentLikeService)
    {
        $this->contentLikeService = $contentLikeService;
    }

    public function decorate(Collection $contents)
    {
        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM) {
            return $contents;
        }

        if (empty($contents->pluck('id')) || empty(auth()->id())) {
            return $contents;
        }

        $likeCounts = $this->contentLikeService->countForContentIds(
            $contents->pluck('id')
                ->toArray()
        );

        $thisUsersLikes = $this->contentLikeService->index(
            $this->contentLikeService->builder()
                ->whereIn(
                    'content_id',
                    $contents->pluck('id')
                        ->toArray()
                )
                ->where('user_id', auth()->id())
        );

        foreach ($contents as $contentIndex => $content) {
            $contents[$contentIndex]['like_count'] = $likeCounts[$content['id']] ?? 0;

            foreach ($thisUsersLikes as $thisUsersLike) {
                if ($thisUsersLike['content_id'] == $content['id']) {
                    $contents[$contentIndex]['is_liked_by_current_user'] = true;
                }
            }
        }

        return $contents;
    }
}
