<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentTopicRepository;

class ContentTopicService
{
    /**
     * @var ContentTopicRepository
     */
    private $contentTopicRepository;

    /**
     * @param ContentTopicRepository $contentTopicRepository
     */
    public function __construct(ContentTopicRepository $contentTopicRepository)
    {
        $this->contentTopicRepository = $contentTopicRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->contentTopicRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->contentTopicRepository->getByContentIds($contentIds);
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
            'topic' => $value,
            'position' => $position,
        ];

        $id = $this->contentTopicRepository->createOrUpdateAndReposition(null, $input);

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
        $topic = $this->get($id);

        if (is_null($topic)) {
            return $topic;
        }

        //don't update if the request not contain any value
        if (count($data) == 0) {
            return $topic;
        }

        $this->contentTopicRepository->createOrUpdateAndReposition($id, $data);

        event(new ElasticDataShouldUpdate($topic['content_id']));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$topic['content_id']);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if exist in the database
        $topic = $this->get($id);
        if (is_null($topic)) {
            return $topic;
        }

        $delete = $this->contentTopicRepository->deleteAndReposition($topic);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$topic['content_id']);

        event(new ElasticDataShouldUpdate($topic['content_id']));

        return $delete;
    }
}