<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Entities\ContentLikes;

class ContentDataWithPostOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param ContentData $contentData
     * @return array
     */
    public function transform(ContentData $contentData)
    {
        $this->setDefaultIncludes(['post']);

        return [
            'id' => $contentData->getId(),
            'content_id' => $contentData->getContent()->getId(),
            'key' => $contentData->getKey(),
            'value' => $contentData->getValue(),
            'position' => $contentData->getPosition(),
        ];
    }

    public function includePost(ContentData $contentData)
    {
        return $this->item($contentData->getContent(), new ContentOldStructureTransformer(), 'post');
    }
}