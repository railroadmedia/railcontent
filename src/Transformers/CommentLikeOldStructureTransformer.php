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
        $extraProperties = [];
        $extra = $commentLike->getExtra();

        if ($extra) {
            foreach ($extra as $item) {
                $extraProperties[$item] = $commentLike->getProperty($item);
            }
        }

        return array_merge(
            $extraProperties,
            [
                'id' => $commentLike->getId(),
                'display_name' => $commentLike->getUser()
                    ->getDisplayName(),
                'avatar_url' => $commentLike->getUser()
                    ->getAvatar(),
                'comment_id' => $commentLike->getComment()
                    ->getId(),
                'user_id' => $commentLike->getUser()
                    ->getId(),
                'created_on' => $commentLike->getCreatedOn(),
            ]
        );
    }
}