<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentSbtBpm;
use Railroad\Railcontent\Entities\ContentTag;
use Railroad\Railcontent\Entities\ContentTopic;

class ContentSbtBpmTransformer extends TransformerAbstract
{
    public function transform(ContentSbtBpm $contentSbtBpm)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentSbtBpm,
                $entityManager->getClassMetadata(get_class($contentSbtBpm))
            )
        ))->toArray();
    }
}