<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentDataTransformer extends TransformerAbstract
{
    public function transform(ContentData $comment)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $comment,
                $entityManager->getClassMetadata(get_class($comment))
            )
        ))->toArray();
    }
}