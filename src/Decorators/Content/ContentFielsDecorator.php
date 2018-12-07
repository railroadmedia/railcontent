<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Resora\Decorators\DecoratorInterface;

class ContentFielsDecorator implements DecoratorInterface
{
    /**
     * @var ContentFieldRepository
     */
    private $contentFieldsRepository;

    /**
     * CommentLikesDecorator constructor.
     *
     * @param CommentLikeRepository $commentLikeRepository
     */
    public function __construct(ContentFieldRepository $contentFieldRepository)
    {
        $this->contentFieldsRepository = $contentFieldRepository;
    }

    public function decorate($contents)
    {
        $contentIds = $contents->pluck('id');

        $contentFields =
            $this->contentFieldsRepository->query()
                ->whereIn('content_id', $contentIds)
                ->get()
                ->groupBy('content_id');

        foreach ($contents as $index => $content) {
            if(!array_key_exists('id', $content)){
                $contents[$index]['fields'] = [];
            } else {
                $contents[$index]['fields'] = $contentFields[$content['id']] ?? [];
            }
        }

        return $contents;
    }
}