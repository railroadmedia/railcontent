<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\ContentPermission;

class ContentPermissionOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param ContentPermission $contentPermission
     * @return array
     */
    public function transform(ContentPermission $contentPermission)
    {
        return [
            'id' => $contentPermission->getId(),
            'content_id' => ($contentPermission->getContent()) ?
                $contentPermission->getContent()
                    ->getId() : null,
            'content_type' => $contentPermission->getContentType(),
            'permission_id' => $contentPermission->getPermission()
                ->getId(),
            'brand' => $contentPermission->getBrand(),
            'name' => $contentPermission->getPermission()
                ->getName(),
        ];
      
    }
}