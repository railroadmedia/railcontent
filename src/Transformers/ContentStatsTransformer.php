<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\ContentStatistics;

class ContentStatsTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
       // 'content',
    ];

    public function transform( $contentStatistics)
    {
        $contentStatistics['content_published_on'] = $contentStatistics['content_published_on']->toDateTimeString();
        return $contentStatistics;

        return [
            'id' => $contentStatistics->getId(),
            'content_id' => $contentStatistics->getContent()
                ->getId(),
            'content_type' => $contentStatistics->getContentType(),
            'content_brand' => $contentStatistics->getContent()
                ->getBrand(),
            'content_published_on' => $contentStatistics->getContentPublishedOn()
                ->toDateTimeString(),
            'total_starts' => $contentStatistics->getStarts(),
            'total_completes' => $contentStatistics->getCompletes(),
            'content_title' => $contentStatistics->getContent()
                ->getTitle(),
            'total_comments' => $contentStatistics->getComments(),
            'total_likes' => $contentStatistics->getLikes(),
            'total_added_to_list' => $contentStatistics->getAddedToList(),
        ];
    }

    public function includeContent(ContentStatistics $contentStatistics)
    {
        return $this->item($contentStatistics->getContent(), new ContentTransformer(), 'content');
    }
}