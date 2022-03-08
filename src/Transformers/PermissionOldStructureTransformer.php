<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class PermissionOldStructureTransformer extends TransformerAbstract
{
    public function transform(Permission $permission)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $permission,
                $entityManager->getClassMetadata(get_class($permission))
            )
        ))->toArray();
    }
}