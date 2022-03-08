<?php

namespace Railroad\Railcontent\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentInstructor;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentInstructorTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'instructor',
    ];

    public function transform(ContentInstructor $contentInstructor)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentInstructor->getInstructor(),
                $entityManager->getClassMetadata(get_class($contentInstructor->getInstructor()))
            )
        ))->toArray();
    }

    public function includeInstructor(ContentInstructor $contentInstructor)
    {
        return $this->item($contentInstructor->getInstructor(), new ContentTransformer(), 'instructor');
    }
}