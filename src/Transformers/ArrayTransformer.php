<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;


class ArrayTransformer extends TransformerAbstract
{

    public function transform($array)
    {
       return $array;
    }

}