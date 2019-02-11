<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\UserContentProgress;

class UserContentProgressTransformer extends TransformerAbstract
{
    public function transform(UserContentProgress $userContentProgress)
    {
        $entityManager = app()->make(EntityManager::class);

        $this->defaultIncludes = ['content'];

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $userContentProgress,
                $entityManager->getClassMetadata(get_class($userContentProgress))
            )
        ))->toArray();
    }

    public function includeContent(UserContentProgress $userContentProgress)
    {
        return $this->item(
            $userContentProgress->getContent(),
            new ContentTransformer(),
            'content'
        );
    }
}