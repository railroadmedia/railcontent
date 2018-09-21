<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Support\Collection;

class DataTransformer extends TransformerAbstract
{
    public function transform($data)
    {
        if(is_null($data)){
            return [];
        }
        if (is_array($data)) {
            return $data;
        }

        if ($data instanceOf Collection) {
            return $data->toArray();
        }

        return $data->getArrayCopy();
    }
}