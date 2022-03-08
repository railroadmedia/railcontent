<?php

namespace Railroad\Railcontent\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class FieldTransformer extends TransformerAbstract
{
    /**
     * @param array $field
     * @return array
     */
    public function transform(array $field)
    {
            if($field['value'] instanceof Carbon){
                $field['value'] = Carbon::parse($field['value'])->toDateTimeString();
            }

        return [
            'id' => $field['content_id'],
            'content_id' => $field['content_id'],
            'key' => $field['key'],
            'value' => $field['value'],
            'position' => $field['position'],
            'type' => $field['type']
        ];
    }
}