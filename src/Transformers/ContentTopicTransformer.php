<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentTopic;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentTopicTransformer extends TransformerAbstract
{
    public function transform(ContentTopic $topic)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $topic,
                $entityManager->getClassMetadata(get_class($topic))
            )
        ))->toArray();
    }
}