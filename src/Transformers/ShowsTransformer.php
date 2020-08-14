<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\Content;

class ShowsTransformer extends TransformerAbstract
{

    public function transform(array $data)
    {
        $results = $this->processItems($data);

        return $results;
    }

    private function processItems($data)
    {
        foreach ($data as $key => $item) {
            if (is_array($item)) {
                $data[$key]=  $this->processItems($item);
            } else {
                if ($item instanceof Content) {
                    $transformer = new ContentOldStructureTransformer();
                    $data[$key] = $transformer->transform($item);
                }
            }
        }

        return $data;
    }
}