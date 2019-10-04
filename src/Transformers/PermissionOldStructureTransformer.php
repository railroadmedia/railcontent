<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Permission;

class PermissionOldStructureTransformer extends TransformerAbstract
{
    public function transform(Permission $permission)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $permission,
                $entityManager->getClassMetadata(get_class($permission))
            )
        ))->toArray();
    }
}