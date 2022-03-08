<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class UserPermissionTransformer extends TransformerAbstract
{
    public function transform(UserPermission $userPermission)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $this->defaultIncludes = ['permission'];

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $userPermission,
                $entityManager->getClassMetadata(get_class($userPermission))
            )
        ))->toArray();
    }

    public function includePermission(UserPermission $userPermission)
    {
        return $this->item(
            $userPermission->getPermission(),
            new PermissionTransformer(),
            'permission'
        );
    }
}