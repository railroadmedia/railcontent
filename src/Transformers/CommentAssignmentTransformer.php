<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\CommentAssignment;

class CommentAssignmentTransformer extends TransformerAbstract
{
    public function transform(CommentAssignment $comment)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $comment,
                $entityManager->getClassMetadata(get_class($comment))
            )
        ))->toArray();
    }

    public function includeComment(CommentAssignment $commentAssignment)
    {
        return $this->item($commentAssignment->getComment(), new CommentTransformer(), 'comment');
    }
}