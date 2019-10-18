<?php

namespace Railroad\Railcontent\Transformers;

use Doctrine\ORM\EntityManager;
use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentData;

class ContentDataOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param ContentData $contentData
     * @return array
     */
    public function transform(ContentData $contentData)
    {
        $entityManager = app()->make(EntityManager::class);

        $serializer = new BasicEntitySerializer();

        $serializedEntity = $serializer->serializeToUnderScores($contentData, $entityManager->getClassMetadata(ContentData::class));

            return array_merge(
                $serializedEntity,
                [
                    'content_id' => $contentData->getContent()
                        ->getId(),
                ]
            );
       
    }
}