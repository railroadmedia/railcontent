<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentBpmRepository;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Repositories\ContentInstructorRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\ContentStyleRepository;
use Railroad\Railcontent\Repositories\ContentTopicRepository;
use Railroad\Railcontent\Repositories\RepositoryBase;

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
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var ContentTopicRepository
     */
    private $contentTopicRepository;
    /**
     * @var ContentInstructorRepository
     */
    private $contentInstructorRepository;
    /**
     * @var ContentStyleRepository
     */
    private $contentStyleRepository;

    private $contentBpmRepository;

    /**
     * @param ContentFieldRepository $fieldRepository
     * @param ContentService $contentService
     * @param ContentRepository $contentRepository
     * @param ContentTopicRepository $contentTopicRepository
     * @param ContentInstructorRepository $contentInstructorRepository
     * @param ContentStyleRepository $contentStyleRepository
     */
    public function __construct(
        ContentFieldRepository $fieldRepository,
        ContentService $contentService,
        ContentRepository $contentRepository,
        ContentTopicRepository $contentTopicRepository,
        ContentInstructorRepository $contentInstructorRepository,
        ContentStyleRepository $contentStyleRepository,
        ContentBpmRepository $contentBpmRepository
    ) {
        $this->fieldRepository = $fieldRepository;
        $this->contentService = $contentService;
        $this->contentRepository = $contentRepository;
        $this->contentTopicRepository = $contentTopicRepository;
        $this->contentInstructorRepository = $contentInstructorRepository;
        $this->contentStyleRepository = $contentStyleRepository;
        $this->contentBpmRepository = $contentBpmRepository;
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
        CacheHelper::deleteCache('content_'.$contentId);

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
        CacheHelper::deleteCache('content_'.$oldField['content_id']);

        CacheHelper::deleteUserFields(null, 'contents');

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

        event(new ContentFieldDeleted($field));

        //delete cache for associated content id
        CacheHelper::deleteCache('content_'.$field['content_id']);

        event(new ElasticDataShouldUpdate($field['content_id']));

        return $deleted;
    }

    /**
     * @param $data
     * @return array
     */
    public function createOrUpdate($data)
    {
        if (in_array($data['key'], config('railcontent.contentColumnNamesForFields', []))) {
            $this->contentRepository->update($data['content_id'], [$data['key'] => $data['value']]);
            // event(new ContentUpdated($id, $content, $data));
        } else {
            $key = ($data['key'] == 'instructor') ? 'instructor_id' : $data['key'];
            $repositoryName = RepositoryBase::REPOSITORYMAPPING[$data['key']] ?? null;
            if ($repositoryName) {
                $repository = app()->make($repositoryName);
                $repository->create([
                                        'content_id' => $data['content_id'],
                                        "$key" => $data['value'],
                                        'position' => $data['position'],
                                    ]);
            }
        }

        $this->fieldRepository->createOrUpdateAndReposition($data['id'], $data);

        $content = $this->contentService->getById($data['content_id']);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$data['content_id']);

        CacheHelper::deleteUserFields(null, 'contents');

        event(new ElasticDataShouldUpdate($data['content_id']));

        return $content;
    }

    /**
     * @param $contentId
     * @param $key
     * @param null $value
     * @return array|mixed|\Railroad\Railcontent\Entities\ContentEntity|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function deleteByContentIdAndKey($contentId, $key, $value = null)
    {
        if (in_array($key, config('railcontent.contentColumnNamesForFields', []))) {
            $this->contentRepository->update($contentId, [$key => null]);
        } else {
            $keyColumnName = ($key == 'instructor') ? 'instructor_id' : $key;

            $repositoryName = RepositoryBase::REPOSITORYMAPPING[$key] ?? null;
            if ($repositoryName) {
                $repository = app()->make($repositoryName);
                $repository->query()
                    ->where(
                        'content_id',
                        $contentId
                    )
                    ->where("$keyColumnName", $value)
                    ->delete();
            }
        }

        $content = $this->contentService->getById($contentId);

        //delete cache associated with the content id
        CacheHelper::deleteCache('content_'.$contentId);

        CacheHelper::deleteUserFields(null, 'contents');

        event(new ElasticDataShouldUpdate($contentId));

        return $content;
    }

}
