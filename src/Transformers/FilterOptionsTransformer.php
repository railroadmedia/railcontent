<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;

class FilterOptionsTransformer extends TransformerAbstract
{

    public function transform($options)
    {
        return $options;
    }
}