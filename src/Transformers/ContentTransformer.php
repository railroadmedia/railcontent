<?php

namespace Railroad\Railcontent\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\Content;

class ContentTransformer extends TransformerAbstract
{
    public function transform(Content $content)
    {
        return [
            'id' => $content->getId(),
            'slug' => $content->getSlug(),
            'sort' => $content->getSort(),
//            'created_at' => Carbon::instance($content->getC())->toDateTimeString(),
//            'updated_at' => Carbon::instance($content->getUpdatedAt())->toDateTimeString(),
        ];
    }
}