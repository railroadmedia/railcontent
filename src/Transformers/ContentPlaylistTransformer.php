<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentKey;
use Railroad\Railcontent\Entities\ContentPlaylist;
use Railroad\Railcontent\Entities\ContentTopic;

class ContentPlaylistTransformer extends TransformerAbstract
{
    public function transform(ContentPlaylist $contentPlaylist)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentPlaylist,
                $entityManager->getClassMetadata(get_class($contentPlaylist))
            )
        ))->toArray();
    }
}