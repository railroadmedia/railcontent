<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentLikes;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentLikeTransformer extends TransformerAbstract
{
    public function transform(ContentLikes $contentLikes)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $this->defaultIncludes = ['content'];

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentLikes,
                $entityManager->getClassMetadata(get_class($contentLikes))
            )
        ))->toArray();
    }

    public function includeContent(ContentLikes $contentLikes)
    {
        return $this->item($contentLikes->getContent(), new ContentTransformer(), 'content');
    }
}