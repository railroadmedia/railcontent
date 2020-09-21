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
        $data = $this->convert_smart_quotes($contentData->getValue());

        return [
            'content_id' => $contentData->getContent()
                ->getId(),
            'key' => $contentData->getKey(),
            'value' => mb_convert_encoding($data, 'UTF-8', 'UTF-8'),
            'position' => $contentData->getPosition(),
        ];
    }

    function convert_smart_quotes($string)
    {
        $search = [
            chr(145),
            chr(146),
            chr(147),
            chr(148),
            chr(151),
        ];

        $replace = [
            "'",
            "'",
            '"',
            '"',
            '-',
        ];

        return str_replace($search, $replace, $string);
    }
}