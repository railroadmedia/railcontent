<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentTagRepository;

class ContentTagService
{
    /**
     * @var ContentTagRepository
     */
    private $contentTagRepository;

    /**
     * @param ContentTagRepository $contentTagRepository
     */
    public function __construct(ContentTagRepository $contentTagRepository)
    {
        $this->contentTagRepository = $contentTagRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->contentTagRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->contentTagRepository->getByContentIds($contentIds);
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
            'tag' => $value,
            'position' => $position,
        ];

        $id = $this->contentTagRepository->createOrUpdateAndReposition(null, $input);

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
        $tag = $this->get($id);

        if (is_null($tag)) {
            return $tag;
        }

        //don't update if the request not contain any value
        if (count($data) == 0) {
            return $tag;
        }

        $this->contentTagRepository->createOrUpdateAndReposition($id, $data);

        event(new ElasticDataShouldUpdate($tag['content_id']));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$tag['content_id']);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if exist in the database
        $tag = $this->get($id);
        if (is_null($tag)) {
            return $tag;
        }

        $delete = $this->contentTagRepository->deleteAndReposition($tag);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$tag['content_id']);

        event(new ElasticDataShouldUpdate($tag['content_id']));

        return $delete;
    }
}