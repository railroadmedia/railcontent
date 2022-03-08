<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentKey;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentKeyTransformer extends TransformerAbstract
{
    public function transform(ContentKey $key)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $key,
                $entityManager->getClassMetadata(get_class($key))
            )
        ))->toArray();
    }
}