<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentSbtExerciseNumber;

class ContentSbtExerciseNumberTransformer extends TransformerAbstract
{
    public function transform(ContentSbtExerciseNumber $contentSbtExerciseNumber)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentSbtExerciseNumber,
                $entityManager->getClassMetadata(get_class($contentSbtExerciseNumber))
            )
        ))->toArray();
    }
}