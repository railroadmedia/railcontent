<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentFocusRepository;

class ContentFocusService
{
    /**
     * @var ContentFocusRepository
     */
    private $contentFocusRepository;

    /**
     * @param ContentFocusRepository $contentFocusRepository
     */
    public function __construct(ContentFocusRepository $contentFocusRepository)
    {
        $this->contentFocusRepository = $contentFocusRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->contentFocusRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->contentFocusRepository->getByContentIds($contentIds);
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
            'focus' => $value,
            'position' => $position,
        ];

        $id = $this->contentFocusRepository->createOrUpdateAndReposition(null, $input);

        event(new ElasticDataShouldUpdate($contentId));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$contentId);

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
        $focus = $this->get($id);

        if (is_null($focus)) {
            return $focus;
        }

        //don't update if the request not contain any value
        if (count($data) == 0) {
            return $focus;
        }

        $this->contentFocusRepository->createOrUpdateAndReposition($id, $data);

        event(new ElasticDataShouldUpdate($focus['content_id']));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$focus['content_id']);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if exist in the database
        $focus = $this->get($id);
        if (is_null($focus)) {
            return $focus;
        }

        $delete = $this->contentFocusRepository->deleteAndReposition($focus);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$focus['content_id']);

        event(new ElasticDataShouldUpdate($focus['content_id']));

        return $delete;
    }
}