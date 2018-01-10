<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentDatumRepository;

class ContentDatumService
{
    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;

    /**
     * DatumService constructor.
     *
     * @param ContentDatumRepository $datumRepository
     */
    public function __construct(ContentDatumRepository $datumRepository)
    {
        $this->datumRepository = $datumRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->datumRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->datumRepository->getByContentIds($contentIds);
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
        $id = $this->datumRepository->createOrUpdateAndReposition(
            null,
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position
            ]
        );

        //call the event that save a new content version in the database
        event(new ContentDatumCreated($contentId));

        //delete cache for the content id
        CacheHelper::deleteCache('content_list_' . $contentId);

        return $this->get($id);
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

        $this->datumRepository->createOrUpdateAndReposition($id, $data);

        //save a content version
        event(new ContentDatumUpdated($datum['content_id']));

        //delete cache for the content id
        CacheHelper::deleteCache('content_list_' . $datum['content_id']);

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

        $delete = $this->datumRepository->deleteAndReposition($datum);

        //save a content version 
        event(new ContentDatumDeleted($datum['content_id']));

        //delete cache for the content id
        CacheHelper::deleteCache('content_list_' . $datum['content_id']);

        return $delete;
    }
}