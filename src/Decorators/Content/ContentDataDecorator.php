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
                ->get();

        foreach ($contents as $index => $content) {
            $contents[$index]['data'] = [];
            foreach ($contentData as $contentDataIndex => $data) {
               // $contentField = (array)$contentField;
                if ($data['content_id'] == $content['id']) {
                     $contents[$index]['data'][] = $data;
                }
            }
        }
        //print_r($contents);
        return $contents;
    }
}