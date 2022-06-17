<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentKeyRepository;

class ContentKeyService
{
    /**
     * @var ContentKeyRepository
     */
    private $contentKeyRepository;

    /**
     * @param ContentKeyRepository $contentKeyRepository
     */
    public function __construct(ContentKeyRepository $contentKeyRepository)
    {
        $this->contentKeyRepository = $contentKeyRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->contentKeyRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->contentKeyRepository->getByContentIds($contentIds);
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
            'key' => $value,
            'position' => $position,
        ];

        $id = $this->contentKeyRepository->createOrUpdateAndReposition(null, $input);

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
        $key = $this->get($id);

        if (is_null($key)) {
            return $key;
        }

        //don't update if the request not contain any value
        if (count($data) == 0) {
            return $key;
        }

        $this->contentKeyRepository->createOrUpdateAndReposition($id, $data);

        event(new ElasticDataShouldUpdate($key['content_id']));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$key['content_id']);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if exist in the database
        $key = $this->get($id);
        if (is_null($key)) {
            return $key;
        }

        $delete = $this->contentKeyRepository->deleteAndReposition($key);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$key['content_id']);

        event(new ElasticDataShouldUpdate($key['content_id']));

        return $delete;
    }
}