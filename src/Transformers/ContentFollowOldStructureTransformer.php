<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\ContentFollows;

class ContentFollowOldStructureTransformer extends TransformerAbstract
{
    public function transform(ContentFollows $contentFollows)
    {
        return [
            'id' => $contentFollows->getId(),
            'content_id' => $contentFollows->getContent()
                ->getId(),
            'user_id' => $contentFollows->getUser()
                ->getId(),
            'created_on' => $contentFollows->getCreatedOn()->toDateTimeString()
        ];
    }

}