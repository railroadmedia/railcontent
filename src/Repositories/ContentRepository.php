<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

/**
 * Class ContentRepository
 *
 * @package Railroad\Railcontent\Repositories
 */
class ContentRepository extends RepositoryBase
{
    /**
     * @param $id
     * @return array|null
     */
    public function getById($id, array $permissions = [])
    {
        return $this->getManyById([$id])[$id] ?? null;
    }

    /**
     * @param $ids
     * @param array $permissions
     * @return array
     */
    public function getManyById($ids, array $permissions = [])
    {
        $fieldsWithContent = $this->queryIndex()
            ->whereIn(ConfigService::$tableContent . '.id', $ids)
            ->get();

        return $this->parseAndGetLinkedContent($fieldsWithContent);
    }

    /**
     * @param $slug
     * @param $parentId
     * @return array
     */
    public function getBySlug($slug, $parentId)
    {
        $fieldsWithContent = $this->queryIndex()
            ->whereIn(ConfigService::$tableContent . '.slug', $slug);

        if (!is_null($parentId)) {
            $fieldsWithContent = $fieldsWithContent->where('parent_id', $parentId);
        }

        $fieldsWithContent = $fieldsWithContent->get();

        return $this->parseAndGetLinkedContent($fieldsWithContent);
    }

    /**
     * Insert a new category in the database, recalculate position and regenerate tree
     *
     * @param string $slug
     * @param string $status
     * @param string $type
     * @param integer $position
     * @param integer $parentId
     * @param string|null $publishedOn
     * @return int
     */
    public function create($slug, $status, $type, $position, $parentId, $publishedOn)
    {
        $id = null;

        $categoryId = $this->queryTable()->insertGetId(
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'position' => $position,
                'parent_id' => $parentId,
                'published_on' => $publishedOn,
                'created_on' => Carbon::now()->toDateTimeString(),
            ]
        );

        return $categoryId;
    }

    /**
     * Update a category record, recalculate position, regenerate tree and return the category id
     *
     * @param $id
     * @param string $slug
     * @param string $status
     * @param string $type
     * @param integer $position
     * @param integer $parentId
     * @param string|null $publishedOn
     * @param string|null $archivedOn
     * @return int $categoryId
     */
    public function update(
        $id,
        $slug,
        $status,
        $type,
        $position,
        $parentId,
        $publishedOn,
        $archivedOn
    ) {
        $this->queryTable()->where('id', $id)->update(
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'position' => $position,
                'parent_id' => $parentId,
                'published_on' => $publishedOn,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => $archivedOn,
            ]
        );

        return $id;
    }

    /**
     * @param int $id
     * @param bool $deleteChildren
     * @return int
     */
    public function delete($id, $deleteChildren = false)
    {
        // unlink fields and data
        $this->unlinkField($id);
        $this->unlinkDatum($id);

        if ($deleteChildren) {
            // unlink children content
            $this->unlinkChildren($id);
        }

        return $this->queryTable()->where('id', $id)->delete();
    }

    /**
     * Unlink all fields for a content id, or pass in the field id to delete a specific content field link
     *
     * @param $contentId
     * @param null $fieldId
     * @return int
     */
    public function unlinkField($contentId, $fieldId = null)
    {
        if (!is_null($fieldId)) {
            return $this->contentFieldsQuery()
                ->where('content_id', $contentId)
                ->where('field_id', $fieldId)
                ->delete();
        }

        return $this->contentFieldsQuery()->where('content_id', $contentId)->delete();
    }

    /**
     * Unlink all datum for a content id, or pass in the field id to delete a specific content datum link
     *
     * @param $contentId
     * @param null $datumId
     * @return int
     */
    public function unlinkDatum($contentId, $datumId = null)
    {
        if (!is_null($datumId)) {
            return $this->contentDataQuery()
                ->where('content_id', $contentId)
                ->where('datum_id', $datumId)
                ->delete();
        }

        return $this->contentDataQuery()->where('content_id', $contentId)->delete();
    }

    /**
     * @param $id
     * @return int
     */
    public function unlinkChildren($id)
    {
        return $this->queryTable()->where('parent_id', $id)->update(['parent_id' => null]);
    }

    /**
     * @return Builder
     */
    public function queryTable()
    {
        return parent::connection()->table(ConfigService::$tableContent);
    }

    /**
     * @return Builder
     */
    public function queryIndex()
    {
        return $this->queryTable()
            ->select(
                [
                    ConfigService::$tableContent . '.id as id',
                    ConfigService::$tableContent . '.slug as slug',
                    ConfigService::$tableContent . '.status as status',
                    ConfigService::$tableContent . '.type as type',
                    ConfigService::$tableContent . '.position as position',
                    ConfigService::$tableContent . '.parent_id as parent_id',
                    ConfigService::$tableContent . '.published_on as published_on',
                    ConfigService::$tableContent . '.created_on as created_on',
                    ConfigService::$tableContent . '.archived_on as archived_on',
                    ConfigService::$tableContentFields . '.field_id as field_id',
                    ConfigService::$tableFields . '.key as field_key',
                    ConfigService::$tableFields . '.value as field_value',
                    ConfigService::$tableFields . '.type as field_type',
                    ConfigService::$tableFields . '.position as field_position',
                ]
            )
            ->leftJoin(
                ConfigService::$tableContentFields,
                ConfigService::$tableContentFields . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->leftJoin(
                ConfigService::$tableFields,
                ConfigService::$tableFields . '.id',
                '=',
                ConfigService::$tableContentFields . '.field_id'
            )
            ->groupBy([ConfigService::$tableFields . '.id', ConfigService::$tableContent . '.id']);
    }

    /**
     * @return Builder
     */
    public function contentFieldsQuery()
    {
        return parent::connection()->table(ConfigService::$tableContentFields);
    }

    /**
     * @return Builder
     */
    public function contentDataQuery()
    {
        return parent::connection()->table(ConfigService::$tableContentData);
    }

    /**
     * @param $fieldsWithContent
     * @return array
     */
    private function parseAndGetLinkedContent($fieldsWithContent)
    {
        $linkedContentIdsToGrab = [];

        foreach ($fieldsWithContent as $fieldWithContent) {
            if ($fieldWithContent['field_type'] === 'content_id') {
                $linkedContentIdsToGrab[] = $fieldWithContent['field_value'];
            }
        }

        $linkedContents = [];

        if (!empty($linkedContentIdsToGrab)) {
            $linkedContents = $this->getManyById($linkedContentIdsToGrab);
        }

        $content = [];

        foreach ($fieldsWithContent as $fieldWithContent) {
            $content[$fieldWithContent['id']] = [
                'slug' => $fieldWithContent['slug'],
                'status' => $fieldWithContent['status'],
                'type' => $fieldWithContent['type'],
                'position' => $fieldWithContent['position'],
                'parent_id' => $fieldWithContent['parent_id'],
                'published_on' => $fieldWithContent['published_on'],
                'created_on' => $fieldWithContent['created_on'],
                'archived_on' => $fieldWithContent['archived_on'],
            ];
        }

        foreach ($fieldsWithContent as $fieldWithContent) {
            if ($fieldWithContent['field_key'] === null) {
                continue;
            }

            if ($fieldWithContent['field_type'] === 'content_id') {

                $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']] = [
                    'slug' => $linkedContents[$fieldWithContent['field_value']]['slug'],
                    'status' => $linkedContents[$fieldWithContent['field_value']]['status'],
                    'type' => $linkedContents[$fieldWithContent['field_value']]['type'],
                    'position' => $linkedContents[$fieldWithContent['field_value']]['position'],
                    'parent_id' => $linkedContents[$fieldWithContent['field_value']]['parent_id'],
                    'published_on' => $linkedContents[$fieldWithContent['field_value']]['published_on'],
                    'created_on' => $linkedContents[$fieldWithContent['field_value']]['created_on'],
                    'archived_on' => $linkedContents[$fieldWithContent['field_value']]['archived_on'],
                ];

                foreach ($linkedContents[$fieldWithContent['field_value']]['fields'] as
                         $linkedContentFieldKey => $linkedContentFieldValue) {

                    $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']]
                    ['fields'][$linkedContentFieldKey] = $linkedContentFieldValue;
                }
            } else {
                // put multiple fields with same key in to an array
                if ($fieldWithContent['field_type'] == 'multiple') {

                    $content[$fieldWithContent['id']]
                    ['fields']
                    [$fieldWithContent['field_key']]
                    [$fieldWithContent['field_position']] =
                        $fieldWithContent['field_value'];
                } else {

                    $content[$fieldWithContent['id']]
                    ['fields']
                    [$fieldWithContent['field_key']] =
                        $fieldWithContent['field_value'];

                }
            }

        }

        return $content;
    }
}