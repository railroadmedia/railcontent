<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentBpmRepository;
use Railroad\Railcontent\Repositories\ContentDatumRepository;

class ContentBpmService
{
    /**
     * @var ContentBpmRepository
     */
    private $contentBpmRepository;

    /**
     * @param ContentBpmRepository $contentBpmRepository
     */
    public function __construct(ContentBpmRepository $contentBpmRepository)
    {
        $this->contentBpmRepository = $contentBpmRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->contentBpmRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->contentBpmRepository->getByContentIds($contentIds);
    }

    /**
     * @param $contentId
     * @param $value
     * @param $position
     * @return array
     */
    public function create($contentId, $value, $position)
    {
        $input = [
            'content_id' => $contentId,
            'bpm' =>  $value,
            'position' => $position
        ];

        $id = $this->contentBpmRepository->createOrUpdateAndReposition(null, $input);

        event(new ElasticDataShouldUpdate($contentId));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_' . $contentId);

        return $this->get($id);
    }

    /**
     * @param integer $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data)
    {
        //check if exists in the database
        $bpm = $this->get($id);

        if (is_null($bpm)) {
            return $bpm;
        }

        //don't update if the request not contain any value
        if (count($data) == 0) {
            return $bpm;
        }

        $this->contentBpmRepository->createOrUpdateAndReposition($id, $data);

        event(new ElasticDataShouldUpdate($bpm['content_id']));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_' . $bpm['content_id']);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if exist in the database
        $bpm = $this->get($id);
        if (is_null($bpm)) {
            return $bpm;
        }

        $delete = $this->contentBpmRepository->deleteAndReposition($bpm);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_' . $bpm['content_id']);

        event(new ElasticDataShouldUpdate($bpm['content_id']));

        return $delete;
    }
}