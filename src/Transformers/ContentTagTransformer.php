<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentTag;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentTagTransformer extends TransformerAbstract
{
    public function transform(ContentTag $contentTag)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentTag,
                $entityManager->getClassMetadata(get_class($contentTag))
            )
        ))->toArray();
    }
}