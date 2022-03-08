<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentFollows;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentFollowTransformer extends TransformerAbstract
{
    public function transform(ContentFollows $contentFollows)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $this->defaultIncludes = ['content'];

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentFollows,
                $entityManager->getClassMetadata(get_class($contentFollows))
            )
        ))->toArray();
    }

    public function includeContent(ContentFollows $contentFollows)
    {
        return $this->item($contentFollows->getContent(), new ContentTransformer(), 'content');
    }
}