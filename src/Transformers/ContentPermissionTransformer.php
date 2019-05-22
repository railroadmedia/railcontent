<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentPermission;

class ContentPermissionTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'permission',
    ];

    public function transform(ContentPermission $contentPermission)
    {
        if ($contentPermission->getContent()) {
            $this->defaultIncludes[] = 'content';
        }

        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentPermission,
                $entityManager->getClassMetadata(get_class($contentPermission))
            )
        ))->toArray();
    }

    public function includePermission(ContentPermission $contentPermission)
    {
        return $this->item($contentPermission->getPermission(), new PermissionTransformer(), 'permission');
    }

    public function includeContent(ContentPermission $contentPermission)
    {
        return $this->item($contentPermission->getContent(), new ContentTransformer(), 'content');
    }
}