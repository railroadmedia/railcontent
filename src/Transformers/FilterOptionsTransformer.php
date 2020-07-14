<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;


class FilterOptionsTransformer extends TransformerAbstract
{

    public function transform($options)
    {
        if(array_key_exists('instructors',$options)){

            $this->defaultIncludes = ['instructor'];
            unset($options['instructors']);
        }

        return $options;
    }

    public function includeInstructor($filterOptions)
    {
        return $this->collection(
            $filterOptions['instructors'],
            new ContentTransformer()
        );
    }
}