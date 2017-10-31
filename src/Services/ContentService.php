<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\ContentVersionRepository;
use Railroad\Railcontent\Repositories\DatumRepository;
use Railroad\Railcontent\Repositories\FieldRepository;

class ContentService
{
    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var ContentVersionRepository
     */
    private $versionRepository;

    /**
     * @var FieldRepository
     */
    private $fieldRepository;

    /**
     * @var DatumRepository
     */
    private $datumRepository;

    // all possible content statuses
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    /**
     * ContentService constructor.
     *
     * @param ContentRepository $contentRepository
     * @param ContentVersionRepository $versionRepository
     * @param FieldRepository $fieldRepository
     * @param DatumRepository $datumRepository
     */
    public function __construct(
        ContentRepository $contentRepository,
        ContentVersionRepository $versionRepository,
        FieldRepository $fieldRepository,
        DatumRepository $datumRepository
    ) {
        $this->contentRepository = $contentRepository;
        $this->versionRepository = $versionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
    }

    /**
     * Call the get by id method from repository and return the category
     *
     * @param integer $id
     * @return array|null
     */
    public function getById($id)
    {
        return $this->contentRepository->getById($id);
    }

    /**
     * Get content based on the slug hierarchy, for example if you have course lessons as children of
     * a course, you can pull the course lesson using the slugs:
     *
     * getBySlugHierarchy('my-parent-course-content-slug', 'my-child-course-lesson-slug');
     *
     *
     * @param array ...$slugs
     * @return array
     */
    public function getBySlugHierarchy(...$slugs)
    {
        return $this->contentRepository->getBySlugHierarchy($slugs);
    }

    /**
     *
     * Returns:
     * ['results' => $lessons, 'total_results' => $totalLessonsAfterFiltering]
     *
     * @param int $page
     * @param int $limit
     * @param string $orderByAndDirection
     * @param array $includedTypes
     * @param array $slugHierarchy
     * @param array $requiredFields
     * @param array $includedFields
     * @param array $requiredUserStates
     * @param array $includedUserStates
     * @param array $requiredUserPlaylists
     * @param array $includedUserPlaylists
     * @return array|null
     */
    public function getFiltered(
        $page,
        $limit,
        $orderByAndDirection,
        array $includedTypes,
        array $slugHierarchy,
        array $requiredFields = [],
        array $includedFields = [],
        array $requiredUserStates = [],
        array $includedUserStates = [],
        array $requiredUserPlaylists = [],
        array $includedUserPlaylists = []
    ) {
        $orderByDirection = substr($orderByAndDirection, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($orderByAndDirection, '-');

        $filter = $this->contentRepository->startFilter(
            $page,
            $limit,
            $orderByColumn,
            $orderByDirection,
            $includedTypes,
            $slugHierarchy
        );

        foreach ($requiredFields as $requiredField) {
            $filter->requireField(...$requiredField);
        }

        foreach ($includedFields as $includedField) {
            $filter->includeField(...$includedField);
        }

        foreach ($requiredUserStates as $requiredUserState) {
            $filter->requireUserStates(...$requiredUserState);
        }

        foreach ($includedUserStates as $includedUserState) {
            $filter->includeUserStates(...$includedUserState);
        }

        foreach ($requiredUserPlaylists as $requiredUserPlaylist) {
            $filter->requireUserPlaylist(...$requiredUserPlaylist);
        }

        foreach ($includedUserPlaylists as $includedUserPlaylist) {
            $filter->includeUserPlaylist(...$includedUserPlaylist);
        }

        return [
            'results' => $filter->retrieveFilter(),
            'total_results' => $filter->countFilter(),
            'filter_options' => $filter->getFilterFields()
        ];
    }

    /**
     * Call the create method from ContentRepository and return the new created content
     *
     * @param string $slug
     * @param string $type
     * @param string $status
     * @param string|null $language
     * @param string|null $publishedOn
     * @param string|null $createdOn
     * @return array
     */
    public function create(
        $slug,
        $type,
        $status,
        $language,
        $publishedOn,
        $createdOn = null
    ) {
        $id =
            $this->contentRepository->create(
                $slug,
                $type,
                $status,
                ConfigService::$brand,
                $language ?? ConfigService::$defaultLanguage,
                $publishedOn,
                $createdOn
            );

        return $this->getById($id);
    }

    /**
     * Update and return the updated content.
     *
     * @param integer $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data)
    {
        $this->contentRepository->update($id, $data);

        return $this->getById($id);
    }

    /**
     * Call the delete method from repository and returns true if the content was deleted
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->contentRepository->delete($id);
    }

    /**
     * Get old version content based on the versionId, restore the content data, link fields and datum
     *
     * @param integer $versionId
     * @return bool
     */
    public function restoreContent($versionId)
    {
        // todo: update with new methods

        //get saved content version from database
        $restoredContentVersion = $this->getContentVersion($versionId);

        $contentId = $restoredContentVersion['content_id'];

        //get old content data
        $oldContent = unserialize($restoredContentVersion['data']);

        //update content with version data
        $this->contentRepository->update(
            $contentId,
            [
                'slug' => $oldContent['slug'],
                'status' => $oldContent['status'],
                'language' => $oldContent['language'],
                'brand' => $oldContent['brand'],
                'created_on' => $oldContent['published_on'],
                'published_on' => $oldContent['published_on'],
                'archived_on' => $oldContent['archived_on']
            ]
        );

        // unlink all fields and datum
        $this->contentRepository->unlinkFields($contentId);
        $this->contentRepository->unlinkData($contentId);

        //link fields from content version
        if (array_key_exists('fields', $oldContent)) {

            foreach ($oldContent['fields'] as $key => $value) {

                if (is_array($value)) {

                    //check if file type is 'content_id'
                    if (array_key_exists('id', $value)) {

                        $linkedContentField = $this->getById($value['id']);

                        //check if the linked content still exist; if not create a new content
                        $linkedContentFieldId = (is_null($linkedContentField)) ?
                            $this->contentRepository->create(
                                $value['slug'],
                                $value['status'],
                                $value['type'],
                                $value['position'],
                                $value['language'],
                                $value['parent_id'],
                                $value['published_on']
                            ) :
                            $linkedContentField['id'];

                        //create field if not exist and link it to content
                        $this->restoreContentField(
                            $contentId,
                            $key,
                            $linkedContentFieldId,
                            'content_id',
                            null
                        );

                    } else {

                        //field type it's multiple
                        foreach ($value as $pos => $val) {
                            //create field if not exist and link it to content
                            $this->restoreContentField($contentId, $key, $val, 'multiple', $pos);
                        }
                    }
                } else {

                    //create field if not exist and link it to content
                    $this->restoreContentField($contentId, $key, $value, 'string', null);
                }
            }
        }

        //link datum from content version
        if (array_key_exists('datum', $oldContent)) {
            foreach ($oldContent['datum'] as $key => $value) {
                $this->restoreContentDatum($contentId, $key, $value);
            }
        }

        return $this->getById($contentId);
    }

    /**
     * Get the content version based on id
     *
     * @param integer $versionId
     * @return mixed
     */
    public function getContentVersion($versionId)
    {
        $restoredContentVersion = $this->versionRepository->get($versionId);
        return $restoredContentVersion;
    }

    /**
     * Create field if not exist and link it to the content
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param string $type
     * @param integer|null $position
     */
    protected function restoreContentField($contentId, $key, $value, $type, $position)
    {
        //get field based on key and value
        $field = $this->fieldRepository->getFieldByKeyAndValue($key, $value);

        //create field if not exist
        $fieldId = (is_null($field)) ?
            $this->fieldRepository->updateOrCreateField(0, $key, $value, $type, $position) :
            $field['id'];

        //link the field with the content
        $this->contentRepository->linkField($contentId, $fieldId);
    }

    /**
     * Create datum if not exist and link it to the content
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     */
    protected function restoreContentDatum($contentId, $key, $value)
    {
        $datum = $this->datumRepository->getDatumByKeyAndValue($key, $value);

        $datumId = (is_null($datum)) ?
            $this->datumRepository->updateOrCreateDatum(0, $key, $value, 0) :
            $datum['id'];

        $this->contentRepository->linkDatum($contentId, $datumId);
    }

    /**
     * Return a string with the linked contents Ids
     *
     * @param integer $contentId
     * @return string
     */
    public function linkedWithContent($contentId)
    {
        $linkedWithContent = $this->contentRepository->getLinkedContent($contentId);

        $linkedContentsIds = implode(',', array_pluck($linkedWithContent, ['content_id']));

        request()->request->add(
            [
                'linked_content_ids' => $linkedContentsIds
            ]
        );

        return $linkedContentsIds;
    }

    /**
     * @param $text
     * @return mixed|string
     */
    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}