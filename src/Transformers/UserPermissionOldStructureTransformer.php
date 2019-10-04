<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\UserPermission;

class UserPermissionOldStructureTransformer extends TransformerAbstract
{
    public function transform(UserPermission $userPermission)
    {
        return [
            'id' => $userPermission->getId(),
            'user_id' => $userPermission->getUser()->getId(),
            'permission_id' => $userPermission->getPermission()->getId(),
            'start_date' => $userPermission->getStartDate()->toDateTimeString(),
            'expiration_date' => ($userPermission->getExpirationDate())?$userPermission->getExpirationDate()->toDateTimeString() : null,
            'created_at' => $userPermission->getCreatedAt()->toDateTimeString(),
            'updated_at' => ($userPermission->getUpdatedAt())? $userPermission->getUpdatedAt()->toDateTimeString():null,
            'name' => $userPermission->getPermission()->getName(),
            'brand' => $userPermission->getPermission()->getBrand()
        ];
    }
}