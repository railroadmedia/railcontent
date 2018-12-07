<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Resora\Decorators\DecoratorInterface;

class ContentDataDecorator implements DecoratorInterface
{
    /**
     * @var ContentDatumRepository
     */
    private $contentDatumRepository;

    public function __construct(ContentDatumRepository $contentDatumRepository)
    {
        $this->contentDatumRepository = $contentDatumRepository;
    }

    public function decorate($contents)
    {
        $contentIds = $contents->pluck('id');

        $contentData =
            $this->contentDatumRepository->query()
                ->whereIn('content_id', $contentIds)
                ->get()
                ->groupBy('content_id');

        foreach ($contents as $index => $content) {
            if(!array_key_exists('id', $content)){
                $contents[$index]['data'] = [];
            } else {
                $contents[$index]['data'] = $contentData[$content['id']] ?? [];
            }
        }

        return $contents;
    }
}