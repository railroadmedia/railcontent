<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Permission;

class CommentTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
'content'
    ];

    public function transform(Comment $comment)
    {
        $entityManager = app()->make(EntityManager::class);

        //if ($comment->getParent()) {
//echo ('am parent');
//dd($this->item($comment->getParent(), new CommentTransformer(), 'comment'));
        //    $this->defaultIncludes[] = 'parent';
       // }

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $comment,
                $entityManager->getClassMetadata(get_class($comment))
            )
        ))->toArray();
    }

    public function includeParent(Comment $comment)
    {
        return $this->item($comment->getParent(), new CommentTransformer(), 'comment');
    }

    public function includeContent(Comment $comment)
    {
        return $this->item($comment->getContent(), new ContentTransformer(), 'content');
    }
}