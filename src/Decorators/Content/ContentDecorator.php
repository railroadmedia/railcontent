<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Support\Collection;
use Railroad\Resora\Decorators\DecoratorInterface;

class ContentDecorator implements DecoratorInterface
{
    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * CommentLikesDecorator constructor.
     *
     * @param CommentLikeRepository $commentLikeRepository
     */
    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function decorate($contentFields)
    {
        $contentIdsToPull = [];

        foreach ($contentFields as $content) {
            if ($content['type'] == 'content_id') {
                $contentIdsToPull[$content['id']] = $content['value'];
            }
        }

        if (!empty($contentIdsToPull)) {
            $linkedContents =
                $this->contentRepository->query()
                    ->whereIn('id', $contentIdsToPull)
                    ->get()
                    ->keyBy('id');
        }

        foreach ($contentFields as $index => $field) {
            if ($field['type'] === 'content_id') {
                $contentFields[$index]['value'] = $linkedContents[$field['value']];
                $contentFields[$index]['type'] = 'content';
            }
        }
        return $contentFields;
    }
}