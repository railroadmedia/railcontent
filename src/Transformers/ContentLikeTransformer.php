<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentLikes;

class ContentLikeTransformer extends TransformerAbstract
{
    public function transform(ContentLikes $contentLikes)
    {
        $entityManager = app()->make(EntityManager::class);

        $this->defaultIncludes = ['content'];

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentLikes,
                $entityManager->getClassMetadata(get_class($contentLikes))
            )
        ))->toArray();
    }

    public function includeContent(ContentLikes $contentLikes)
    {
        return $this->item($contentLikes->getContent(), new ContentTransformer(), 'content');
    }
}