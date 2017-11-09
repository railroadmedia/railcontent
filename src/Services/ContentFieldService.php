<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Repositories\ContentFieldRepository;

class ContentFieldService
{
    /**
     * @var ContentFieldRepository
     */
    private $fieldRepository;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * FieldService constructor.
     *
     * @param ContentFieldRepository $fieldRepository
     * @param ContentService $contentService
     */
    public function __construct(ContentFieldRepository $fieldRepository, ContentService $contentService)
    {
        $this->fieldRepository = $fieldRepository;
        $this->contentService = $contentService;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        $contentField = $this->fieldRepository->getById($id);
        
        if (!empty($contentField) && $contentField['type'] == 'content') {
            $contentField['value'] = $this->contentService->getById($contentField['value']);
        }

        return $contentField;
    }

    /**
     * Create a new field and return it.
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param string $position
     * @param string $type
     * @return array
     */
    public function create($contentId, $key, $value, $position, $type)
    {
        $id = $this->fieldRepository->create(
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position,
                'type' => $type,
            ]
        );

        //Fire an event that the content was modified
        event(new ContentFieldCreated($contentId));

        return $this->get($id);
    }

    /**
     * @param integer $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data)
    {
        //Check if field exist in the database
        $field = $this->get($id);

        if (is_null($field)) {
            return $field;
        }

        if (count($data) == 0) {
            return $field;
        }

        $this->fieldRepository->update($id, $data);

        //Save a new content version
        event(new ContentFieldUpdated($field['content_id']));

        return $this->get($id);
    }

    /**
     * Call the repository method to unlink the content's field
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //Check if field exist in the database
        $field = $this->get($id);

        if (is_null($field)) {
            return $field;
        }

        $deleted = $this->fieldRepository->delete($id);

        //Save a new content version
        event(new ContentFieldDeleted($field['content_id']));

        return $deleted;
    }

}