<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Doctrine\Serializers\BasicEntitySerializer;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Entities\ContentLikes;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class ContentDataWithPostOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param ContentData $contentData
     * @return array
     */
    public function transform(ContentData $contentData)
    {
        $entityManager = app()->make(RailcontentEntityManager::class);

        $serializer = new BasicEntitySerializer();

        $this->setDefaultIncludes(['post']);

        return $serializer->serializeToUnderScores($contentData, $entityManager->getClassMetadata(ContentData::class));
    }

    public function includePost(ContentData $contentData)
    {
        return $this->item($contentData->getContent(), new ContentOldStructureTransformer(), 'post');
    }
}