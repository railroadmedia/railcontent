<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Repositories\ContentRepository;

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

        if (!empty($contentField) && $contentField['type'] == 'content_id') {
            $contentField['value'] = $this->contentService->getById($contentField['value']);
        }

        return $contentField;
    }

    /**
     * @param $key
     * @param $value
     * @param $type
     * @param $position
     * @return array
     */
    public function getByKeyValueTypePosition($key, $value, $type, $position)
    {
        $contentFields = $this->fieldRepository->getByKeyValueTypePosition($key, $value, $type, $position);

        $contentIds = [];
        $contents = [];

        foreach ($contentFields as $contentField) {
            if (!empty($contentField) && $contentField['type'] == 'content_id') {
                $contentIds[] = $contentField['value'];
            }
        }

        if (!empty($contentIds)) {
            $contents = $this->contentService->getByIds($contentIds);
        }

        foreach ($contentFields as $contentFieldIndex => $contentField) {
            foreach ($contents as $content) {
                if ($contentField['type'] == 'content_id' && $contentField['value'] == $content['id']) {
                    $contentFields[$contentFieldIndex]['value'] = $content;
                }
            }
        }

        return $contentFields;
    }

    /**
     * @param $key
     * @param $value
     * @param $type
     * @return array
     */
    public function getByKeyValueType($key, $value, $type)
    {
        $contentFields = $this->fieldRepository->getByKeyValueType($key, $value, $type);

        $contentIds = [];
        $contents = [];

        foreach ($contentFields as $contentField) {
            if (!empty($contentField) && $contentField['type'] == 'content_id') {
                $contentIds[] = $contentField['value'];
            }
        }

        if (!empty($contentIds)) {
            $contents = $this->contentService->getByIds($contentIds);
        }

        foreach ($contentFields as $contentFieldIndex => $contentField) {
            foreach ($contents as $content) {
                if ($contentField['type'] == 'content_id' && $contentField['value'] == $content['id']) {
                    $contentFields[$contentFieldIndex]['value'] = $content;
                }
            }
        }

        return $contentFields;
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
        $input = [
            'content_id' => $contentId,
            'key' => $key,
            'value' => $value,
            'position' => $position,
            'type' => $type,
        ];

        $id = $this->fieldRepository->createOrUpdateAndReposition(null, $input);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_' . $contentId);

        $newField = $this->get($id);

        event(new ContentFieldCreated($newField, $input));

        return $newField;
    }

    /**
     * @param integer $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data)
    {
        //Check if field exist in the database
        $oldField = $this->get($id);

        if (is_null($oldField)) {
            return $oldField;
        }

        if (count($data) == 0) {
            return $oldField;
        }

        $this->fieldRepository->createOrUpdateAndReposition($id, $data);

        //delete cache for associated content id
        CacheHelper::deleteCache('content_' . $oldField['content_id']);

        $newField = $this->get($id);

        event(new ContentFieldUpdated($newField, $oldField));

        return $newField;
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
            return false;
        }

        $deleted = $this->fieldRepository->deleteAndReposition(['id' => $id]);

//        event(new ContentFieldDeleted($field));

        //delete cache for associated content id
        CacheHelper::deleteCache('content_' . $field['content_id']);

        return $deleted;
    }

    /**
     * @param $data
     * @return array
     */
    public function createOrUpdate($data)
    {
        $oldField = $this->get($data['content_id']);
        if (ContentRepository::$version == 'new' && in_array($data['key'], config('railcontentNewStructure.content_columns', []))) {
            $newField = $data;
            $this->contentService->update($data['content_id'], [$data['key'] => $data['value']]);
        }
     else {
         $id = $this->fieldRepository->createOrUpdateAndReposition($data['id'] ?? null, $data);
         $newField = $this->get($id);
     }

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_' . $data['content_id']);



        if(array_key_exists('id',$data)) {
            event(new ContentFieldUpdated($newField, $oldField));
        } else {
            event(new ContentFieldCreated($newField, $data));
        }

        return $newField;
    }

}