<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\CommentLikes;

class CommentLikeTransformer extends TransformerAbstract
{
    public function transform(CommentLikes $comment)
    {
        $entityManager = app()->make(EntityManager::class);

        $this->defaultIncludes = ['comment'];

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $comment,
                $entityManager->getClassMetadata(get_class($comment))
            )
        ))->toArray();
    }

    public function includeComment(CommentLikes $comment)
    {
        return $this->item($comment->getComment(), new CommentTransformer(), 'comment');
    }
}