<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentKeyPitchTypeRepository;

class ContentKeyPitchTypeService
{
    /**
     * @var ContentKeyPitchTypeRepository
     */
    private $contentKeyPitchTypeRepository;

    /**
     * @param ContentKeyPitchTypeRepository $contentKeyPitchTypeRepository
     */
    public function __construct(ContentKeyPitchTypeRepository $contentKeyPitchTypeRepository)
    {
        $this->contentKeyPitchTypeRepository = $contentKeyPitchTypeRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->contentKeyPitchTypeRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->contentKeyPitchTypeRepository->getByContentIds($contentIds);
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
            'key_pitch_type' => $value,
            'position' => $position,
        ];

        $id = $this->contentKeyPitchTypeRepository->createOrUpdateAndReposition(null, $input);

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
        $keyPitchType = $this->get($id);

        if (is_null($keyPitchType)) {
            return $keyPitchType;
        }

        //don't update if the request not contain any value
        if (count($data) == 0) {
            return $keyPitchType;
        }

        $this->contentKeyPitchTypeRepository->createOrUpdateAndReposition($id, $data);

        event(new ElasticDataShouldUpdate($keyPitchType['content_id']));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$keyPitchType['content_id']);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if exist in the database
        $keyPitchType = $this->get($id);
        if (is_null($keyPitchType)) {
            return $keyPitchType;
        }

        $delete = $this->contentKeyPitchTypeRepository->deleteAndReposition($keyPitchType);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$keyPitchType['content_id']);

        event(new ElasticDataShouldUpdate($keyPitchType['content_id']));

        return $delete;
    }
}