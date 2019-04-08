<?php

namespace Railroad\Railcontent\Transformers;

use ArrayAccess;
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

        foreach ($data as $rowIndex => $row) {
            if ((is_array($row) || $row instanceof ArrayAccess) && isset($row['lessons'])) {
                unset($data[$rowIndex]['lessons']);
            }

            if ($rowIndex == 'lessons') {
                unset($data[$rowIndex]);
            }
        }

        return $data->getArrayCopy();
    }
}