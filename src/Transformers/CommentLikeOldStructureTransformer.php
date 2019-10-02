<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\CommentLikes;

class CommentLikeOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param CommentLikes $commentLike
     * @return array
     */
    public function transform(CommentLikes $commentLike)
    {
        return [
            'id' => $commentLike->getId(),
            'display_name' => $commentLike->getUser()
                ->getDisplayName(),
            'avatar_url' => $commentLike->getUser()
                ->getAvatar(),
        ];
    }
}