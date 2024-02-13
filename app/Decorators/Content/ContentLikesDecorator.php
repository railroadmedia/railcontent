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

    public static $skip = false;

    /**
     * ContentLikesDecorator constructor.
     */
    public function __construct(ContentLikeService $contentLikeService)
    {
        $this->contentLikeService = $contentLikeService;
    }

    public function decorate(Collection $contents)
    {
        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM || self::$skip) {
            return $contents;
        }

        if (empty($contents->pluck('id')) || empty(auth()->id())) {
            return $contents;
        }

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
            $contents[$contentIndex]['is_liked_by_current_user'] = false;
            foreach ($thisUsersLikes as $thisUsersLike) {
                if ($thisUsersLike['content_id'] == $content['id']) {
                    $contents[$contentIndex]['is_liked_by_current_user'] = true;
                }
            }
        }

        return $contents;
    }
}
