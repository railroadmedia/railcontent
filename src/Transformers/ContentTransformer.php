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
        return $contents;
    }

    public function serializeInstructor($content)
    {
        return $this->item(
            $content->getInstructor(),
            new ContentTransformer(),
            'instructor'
        );
    }

    public function serializeContentData($content)
    {
        return fractal()
            ->serializeWith(new ArraySerializer())
            ->collection($content->getData())
            ->transformWith(ContentDataTransformer::class)
            ->toArray();
    }
}