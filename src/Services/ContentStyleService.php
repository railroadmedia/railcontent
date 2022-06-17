<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentStyleRepository;

class ContentStyleService
{
    /**
     * @var ContentStyleRepository
     */
    private $contentStyleRepository;

    /**
     * @param ContentStyleRepository $contentStyleRepository
     */
    public function __construct(ContentStyleRepository $contentStyleRepository)
    {
        $this->contentStyleRepository = $contentStyleRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->contentStyleRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->contentStyleRepository->getByContentIds($contentIds);
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
            'style' => $value,
            'position' => $position,
        ];

        $id = $this->contentStyleRepository->createOrUpdateAndReposition(null, $input);

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
        $style = $this->get($id);

        if (is_null($style)) {
            return $style;
        }

        //don't update if the request not contain any value
        if (count($data) == 0) {
            return $style;
        }

        $this->contentStyleRepository->createOrUpdateAndReposition($id, $data);

        event(new ElasticDataShouldUpdate($style['content_id']));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$style['content_id']);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if exist in the database
        $style = $this->get($id);
        if (is_null($style)) {
            return $style;
        }

        $delete = $this->contentStyleRepository->deleteAndReposition($style);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$style['content_id']);

        event(new ElasticDataShouldUpdate($style['content_id']));

        return $delete;
    }
}