<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentTag;

class ContentTagTransformer extends TransformerAbstract
{
    public function transform(ContentTag $contentTag)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentTag,
                $entityManager->getClassMetadata(get_class($contentTag))
            )
        ))->toArray();
    }
}