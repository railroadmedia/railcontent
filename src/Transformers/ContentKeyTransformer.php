<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentKey;
use Railroad\Railcontent\Entities\ContentTopic;

class ContentKeyTransformer extends TransformerAbstract
{
    public function transform(ContentKey $key)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $key,
                $entityManager->getClassMetadata(get_class($key))
            )
        ))->toArray();
    }
}