<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Helpers\CacheHelper;
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
        return $this->fieldRepository->read($id);
    }

    /**
     * @param integer $id
     * @return array
     */
    public function getByKeyValueTypePosition($key, $value, $type, $position)
    {
        return $this->fieldRepository->query()
            ->where(
                ['key' => $key, 'value' => $value, 'type' => $type, 'position' => $position]
            )
            ->get();

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
     * @param integer $id
     * @return array
     */
    public function getByKeyValueType($key, $value, $type)
    {
        return $this->fieldRepository->query()
            ->where(
                ['key' => $key, 'value' => $value, 'type' => $type]
            )
            ->get();

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
        $field = $this->fieldRepository->createOrUpdateAndReposition(
            null,
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

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_' . $contentId);

        return $field;
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

        $this->fieldRepository->createOrUpdateAndReposition($id, $data);

        //Save a new content version
        event(new ContentFieldUpdated($field['content_id']));

        //delete cache for associated content id
        CacheHelper::deleteCache('content_' . $field['content_id']);

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

        $deleted = $this->fieldRepository->deleteAndReposition(['id' => $id]);

        //Save a new content version
        event(new ContentFieldDeleted($field['content_id']));

        //delete cache for associated content id
        CacheHelper::deleteCache('content_' . $field['content_id']);

        return $deleted;
    }

    public function createOrUpdate($data)
    {
        $id = $this->fieldRepository->createOrUpdateAndReposition(
            $data['id'] ?? null,
            $data
        );

        //Fire an event that the content was modified
        if (array_key_exists('id', $data)) {
            event(new ContentFieldUpdated($data['content_id']));
        } else {
            event(new ContentFieldCreated($data['content_id']));
        }

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_' . $data['content_id']);

        return $this->get($id['id']);
    }

}