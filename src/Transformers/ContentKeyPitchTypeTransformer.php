<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentKeyPitchType;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentKeyPitchTypeTransformer extends TransformerAbstract
{
    public function transform(ContentKeyPitchType $keyPitchType)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $keyPitchType,
                $entityManager->getClassMetadata(get_class($keyPitchType))
            )
        ))->toArray();
    }
}