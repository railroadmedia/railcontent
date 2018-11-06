<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Support\Collection;
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
                ->get();

        foreach ($contents as $index => $content) {
            $contents[$index]['fields'] = [];
            foreach ($contentFields as $contentFieldIndex => $contentField) {
                $contentField = (array)$contentField;
                if ($contentField['content_id'] == $content['id']) {
                    $contents[$index]['fields'][] = $contentField;
                }
            }
        }
        return $contents;
    }
}