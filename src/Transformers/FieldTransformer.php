<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;

class FieldTransformer extends TransformerAbstract
{
    /**
     * @param array $field
     * @return array
     */
    public function transform(array $field)
    {
        return [
            'content_id' => $field['content_id'],
            'key' => $field['key'],
            'value' => $field['value'],
            'position' => $field['position'],
        ];
    }
}