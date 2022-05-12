<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentInstructorRepository;

class ContentInstructorService
{
    /**
     * @var ContentInstructorRepository
     */
    private $contentInstructorRepository;

    /**
     * @param ContentInstructorRepository $contentInstructorRepository
     */
    public function __construct(ContentInstructorRepository $contentInstructorRepository)
    {
        $this->contentInstructorRepository = $contentInstructorRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->contentInstructorRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->contentInstructorRepository->getByContentIds($contentIds);
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
            'instructor_id' => $value,
            'position' => $position,
        ];

        $id = $this->contentInstructorRepository->createOrUpdateAndReposition(null, $input);

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
        $contentInstructor = $this->get($id);

        if (is_null($contentInstructor)) {
            return $contentInstructor;
        }

        //don't update if the request not contain any value
        if (count($data) == 0) {
            return $contentInstructor;
        }

        $this->contentInstructorRepository->createOrUpdateAndReposition($id, $data);

        event(new ElasticDataShouldUpdate($contentInstructor['content_id']));

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$contentInstructor['content_id']);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if exist in the database
        $contentInstructor = $this->get($id);
        if (is_null($contentInstructor)) {
            return $contentInstructor;
        }

        $delete = $this->contentInstructorRepository->deleteAndReposition($contentInstructor);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$contentInstructor['content_id']);

        event(new ElasticDataShouldUpdate($contentInstructor['content_id']));

        return $delete;
    }
}