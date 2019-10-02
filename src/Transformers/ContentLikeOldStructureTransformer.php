<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\ContentLikes;

class ContentLikeOldStructureTransformer extends TransformerAbstract
{
    public function transform(ContentLikes $contentLikes)
    {
        return [
            'id' => $contentLikes->getId(),
            'content_id' => $contentLikes->getContent()
                ->getId(),
            'user_id' => $contentLikes->getUser()
                ->getId(),
            'created_on' => $contentLikes->getCreatedOn()->toDateTimeString(),
            'display_name' => $contentLikes->getUser()
                ->getDisplayName(),
            'avatar_url' => $contentLikes->getUser()
                ->getAvatar(),
        ];
    }

}