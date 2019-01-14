<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\EntityManager;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentDatumRepository;

class ContentDatumService
{
    private $entityManager;
    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;

    /**
     * DatumService constructor.
     *
     * @param ContentDatumRepository $datumRepository
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->datumRepository = $this->entityManager->getRepository(ContentData::class);
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->datumRepository->find($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->datumRepository->query()->getByContentIds($contentIds);
    }

    /**
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param integer $position
     * @return array
     */
    public function create($contentId, $key, $value, $position)
    {
        $contentDatum = $this->datumRepository->reposition(
            null,
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position
            ]
        );

        //call the event that save a new content version in the database
       // event(new ContentDatumCreated($contentId));

        //delete cache associated with the content id
       // CacheHelper::deleteCache('content_' . $contentId);

        return $this->get($contentDatum->getId());
    }

    /**
     * @param integer $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data)
    {
        //check if datum exist in the database
        $datum = $this->get($id);

        if (is_null($datum)) {
            return $datum;
        }

        //don't update the datum if the request not contain any value
        if (count($data) == 0) {
            return $datum;
        }

        $this->datumRepository->reposition($id, $data);

        //save a content version
//        event(new ContentDatumUpdated($datum['content_id']));

        //delete cache associated with the content id
     //   CacheHelper::deleteCache('content_' . $datum['content_id']);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if datum exist in the database
        $datum = $this->get($id);

        if (is_null($datum)) {
            return $datum;
        }

        $delete = $this->datumRepository->deleteAndReposition(['id' => $id]);

        //save a content version 
      //  event(new ContentDatumDeleted($datum['content_id']));

        //delete cache associated with the content id
      //  CacheHelper::deleteCache('content_' . $datum['content_id']);

        return $delete;
    }
}