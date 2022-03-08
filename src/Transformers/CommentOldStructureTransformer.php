<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class CommentOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param Comment $comment
     * @return array
     */
    public function transform(Comment $comment)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        $extraProperties = [];
        $extra = $comment->getExtra();

        if ($extra) {
            foreach ($extra as $item) {
                $value = $comment->getProperty($item);

                if (is_array($value)) {
                    if (empty($value)) {
                        $extraProperties[$item] = [];
                    }
                    foreach ($value as $val) {
                        if (is_object($val)) {
                            $extraProperties[$item][] = $serializer->serialize(
                                $val,
                                $entityManager->getClassMetadata(get_class($val))
                            );
                        } else {
                            $extraProperties[$item] = $value;
                        }
                    }
                } else {
                    $extraProperties[$item] = $value;
                }
            }
        }

        $defaultIncludes = [];

        if (count($comment->getLikes()) > 0) {
            $defaultIncludes[] = 'like_users';
        }

        if (count($comment->getChildren()) > 0) {
            $defaultIncludes[] = 'replies';
        }
        if ($comment->getUser()) {
            $defaultIncludes[] = 'user';
        }

        $this->setDefaultIncludes($defaultIncludes);

        $value = $comment->getComment();
        if(mb_check_encoding($value) == false){
            $value = utf8_encode($value);
        }

        return array_merge(
            [
                'id' => $comment->getId(),
                'comment' => $value,
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
                'deleted_at' => ($comment->getDeletedAt()) ?
                    $comment->getDeletedAt()
                        ->toDateTimeString() : null,
                'like_count' => ($comment->getLikes()) ?
                    $comment->getLikes()
                        ->count() : 0,
                'is_liked' => ($comment->getProperty('is_liked')) ? $comment->getProperty('is_liked') : false,
                'replies' => []
            ],
            $extraProperties
        );
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

    /**
     * @param Comment $comment
     * @return Collection
     */
    public function includeUser(Comment $comment)
    {

        return $this->item(
            $comment->getUser(),
            new UserTransformer(),
            'user'
        );
    }
}
