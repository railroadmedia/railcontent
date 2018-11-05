<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Support\Collection;
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

        $contentDatum =
            $this->contentDatumRepository->query()
                ->whereIn('content_id', $contentIds)
                ->get();
        $contents = $contents->toArray();

        foreach ($contents as $index => $content) {
            $contents[$index]['data'] = [];
            foreach ($contentDatum as $contentDataIndex => $contentData) {
                $contentData = (array)$contentData;
                if ($contentData['content_id'] == $content['id']) {
                    $contents[$index]['data'][] = $contentData;
                }
            }
        }
        return new Collection($contents);
    }
}