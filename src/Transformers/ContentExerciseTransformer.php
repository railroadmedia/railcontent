<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Entities\ContentExercise;
use Railroad\Railcontent\Entities\ContentInstructor;

class ContentExerciseTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'exercise',
    ];

    public function transform(ContentExercise $contentExercise)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        return (new Collection(
            $serializer->serializeToUnderScores(
                $contentExercise,
                $entityManager->getClassMetadata(get_class($contentExercise))
            )
        ))->toArray();
    }

    public function includeExercise(ContentExercise $contentExercise)
    {
        return $this->item($contentExercise->getExercise(), new ContentTransformer(), 'exercise');
    }
}