<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentHierarchy;

class ContentHierarchyChildrensOldStructureTransformer extends TransformerAbstract
{

    public function transform(ContentHierarchy $contentHierarchy)
    {
        return ['child_id' =>  $contentHierarchy->getChild()->getId()];
    }


}