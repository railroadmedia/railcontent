<?php

namespace Railroad\Railcontent\Transformers;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentData;

class ContentTransformer extends TransformerAbstract
{
    public function transform(Content $content)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        $contents = (new Collection(
            $serializer->serializeToUnderScores(
                $content,
                $entityManager->getClassMetadata(get_class($content))
            )
        ))->toArray();

        if ($content->getData()) {
            $contents['relationships']['contentData'] = $this->serializeContentData($content);
        }

        if($content->getInstructor()){
            $contents['relationships']['instructor'] = $this->serializeInstructor($content);
        }

        if ($content->getTopic()) {
            $contents['relationships']['topic'] = $this->serializeContentTopic($content);
        }

        if($content->getExercise()){
            $contents['relationships']['exercise'] = $this->serializeExercise($content);
        }
        return $contents;
    }

    public function serializeInstructor($content)
    {
        return fractal()
            ->serializeWith(new ArraySerializer())
            ->collection($content->getInstructor(), ContentInstructorTransformer::class)
            ->toArray();
    }
    public function serializeExercise($content)
    {
        return fractal()
            ->serializeWith(new ArraySerializer())
            ->collection($content->getExercise(), ContentExerciseTransformer::class)
            ->toArray();
    }
    public function serializeContentData($content)
    {
        return fractal()
            ->serializeWith(new ArraySerializer())
            ->collection($content->getData())
            ->transformWith(ContentDataTransformer::class)
            ->toArray();
    }

    public function serializeContentTopic($content)
    {
        return fractal()
            ->serializeWith(new ArraySerializer())
            ->collection($content->getTopic())
            ->transformWith(ContentTopicTransformer::class)
            ->toArray();
    }
}