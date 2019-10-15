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
        $value = $contentData->getValue();
        if(mb_check_encoding($value) == false){
            $value = utf8_encode($value);
        }

        return [
            'content_id' => $contentData->getContent()->getId(),
            'key' => $contentData->getKey(),
            'value' => $value,
            'position' => $contentData->getPosition(),
        ];
    }
}