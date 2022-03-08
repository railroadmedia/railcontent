<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentHierarchyTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'parent', 'child'
    ];

    public function transform(ContentHierarchy $contentHierarchy)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentHierarchy,
                $entityManager->getClassMetadata(get_class($contentHierarchy))
            )
        ))->toArray();
    }

    public function includeParent(ContentHierarchy $contentHierarchy)
    {
        return $this->item($contentHierarchy->getParent(), new ContentTransformer(), 'content');
    }

    public function includeChild(ContentHierarchy $contentHierarchy)
    {
        return $this->item($contentHierarchy->getChild(), new ContentTransformer(), 'content');
    }
}