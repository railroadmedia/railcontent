<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\ContentData;

class ContentDataOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param ContentData $contentData
     * @return array
     */
    public function transform(ContentData $contentData)
    {
        return [
            'content_id' => $contentData->getContent()->getId(),
            'key' => $contentData->getKey(),
            'value' => $contentData->getValue(),
            'position' => $contentData->getPosition(),
        ];
    }
}