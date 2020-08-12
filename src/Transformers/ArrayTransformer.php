<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;

class ArrayTransformer extends TransformerAbstract
{
    protected $keys;
    protected $values;
    public function __construct($keys=null, $values=null) {
        $this->keys = $keys;
        $this->values = $values;
    }

    public function transform($array)
    {
        if(($this->keys)&&($this->values)){
            return array_combine($this->keys, $this->values);
        }

        return $array;
    }

}