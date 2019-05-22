<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentInstructor;

class ContentInstructorTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'instructor',
    ];

    public function transform(ContentInstructor $contentInstructor)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentInstructor,
                $entityManager->getClassMetadata(get_class($contentInstructor))
            )
        ))->toArray();
    }

    public function includeInstructor(ContentInstructor $contentInstructor)
    {
        return $this->item($contentInstructor->getInstructor(), new ContentTransformer(), 'instructor');
    }
}