<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class CommentTransformer extends TransformerAbstract
{
    public function transform(Comment $comment)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        if (count($comment->getChildren()) > 0) {
            $this->defaultIncludes = ['content', 'replies','user'];
        } else {
            $this->defaultIncludes = ['content','user'];
        }

        $serializer = new BasicEntitySerializer();

        $extraProperties = [];
        $extra = $comment->getExtra();

        if ($extra) {
            foreach ($extra as $item) {
                $value = $comment->getProperty($item);
                if(is_array($value)) {
                    foreach ($value as $val) {
                        if (is_object($val)) {
                            $extraProperties[$item][] =  $serializer->serialize(
                                $val,
                                $entityManager->getClassMetadata(get_class($val))
                            );
                        }else{
                            $extraProperties[$item][] = $value;
                        }
                    }
                } else {
                    $extraProperties[$item] = $value;
                }
            }
        }

        return (new Collection(
            array_merge(
            $serializer->serializeToUnderScores(
                $comment,
                $entityManager->getClassMetadata(get_class($comment))
            ), $extraProperties)
        ))->toArray();
    }

    public function includeReplies(Comment $comment)
    {
        return $this->collection(
            $comment->getChildren(),
            new CommentTransformer(),
            'comment'
        );
    }

    public function includeContent(Comment $comment)
    {
        return $this->item($comment->getContent(), new ContentTransformer(), 'content');
    }

    public function includeUser(Comment $comment)
    {
        return $this->item($comment->getUser(), new UserTransformer(), 'user');
    }
}