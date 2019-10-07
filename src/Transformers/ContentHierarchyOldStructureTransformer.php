<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentHierarchy;

class ContentHierarchyOldStructureTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'post',
    ];

    public function transform(ContentHierarchy $contentHierarchy)
    {
        return [];
    }

    public function includePost(ContentHierarchy $contentHierarchy)
    {
        return $this->item($contentHierarchy->getParent(), new ContentOldStructureTransformer(), 'post');
    }
}