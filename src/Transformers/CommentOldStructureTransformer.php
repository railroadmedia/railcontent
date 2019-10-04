<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\Comment;

class CommentOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param Comment $comment
     * @return array
     */
    public function transform(Comment $comment)
    {
        $defaultIncludes = ['like_users'];

        if (count($comment->getChildren()) > 0) {
            $defaultIncludes[] = 'replies';
        }

        $this->setDefaultIncludes($defaultIncludes);

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
            'like_count' => $comment->getLikes()
                ->count(),
            'is_liked' => $comment->getProperty('is_liked')
        ];
    }

    /**
     * @param Comment $comment
     * @return Collection
     */
    public function includeReplies(Comment $comment)
    {
        return $this->collection(
            $comment->getChildren(),
            new CommentOldStructureTransformer(),
            'comment'
        );
    }

    /**
     * @param Comment $comment
     * @return Collection
     */
    public function includeLikeUsers(Comment $comment)
    {
        return $this->collection(
            $comment->getLikes(),
            new CommentLikeOldStructureTransformer(),
            'commentLikes'
        );
    }
}