<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\Comment;


class CommentOldStructureTransformer extends TransformerAbstract
{
    public function transform(Comment $comment)
    {

        if (count($comment->getChildren()) > 0) {
            $this->defaultIncludes = ['replies'];
        } else {
            $this->defaultIncludes = [];
        }

         $replies = [];

        if (!$comment->getChildren()
            ->isEmpty()) {
            foreach ($comment->getChildren() as $child) {
                $replies[] = self::transform($child);
            }
        }

        return [
            'id' => $comment->getId(),
            'comment' => $comment->getComment(),
            'content_id' => $comment->getContent()
                ->getId(),
            'parent_id' => ($comment->getParent()) ?
                $comment->getParent()
                    ->getId() : null,
            'user_id' => $comment->getUser()
                ->getId(),
            'display_name' => $comment->getTemporaryDisplayName(),
            'created_on' => $comment->getCreatedOn()
                ->toDateTimeString(),
            'deleted_on' => ($comment->getDeletedAt()) ?
                $comment->getDeletedAt()
                    ->toDateTimeString() : null,
            'replies' => $replies,
            'like_count' => $comment->getLikes()
                ->count(),
        ];
    }
}