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
    }

    public function includeContent(ContentStatistics $contentStatistics)
    {
        return $this->item($contentStatistics->getContent(), new ContentTransformer(), 'content');
    }
}