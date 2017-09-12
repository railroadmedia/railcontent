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
    public function getById($id)
    {
        //get user permissions from request
        $permissions = request()->request->get('permissions') ?? [];

        return $this->getManyById([$id],$permissions)[$id] ?? null;
    }

    /**
     * @param $ids
     * @param array $permissions
     * @return array
     */
    public function getManyById($ids, array $permissions = [])
    {
        $fieldsWithContent = $this->queryIndex();

        //check if use have permission to view the content
        $fieldsWithContent->where(function($builder) use ($permissions) {
           return $builder->whereNull(ConfigService::$tablePermissions.'.name')
                ->orWhereIn(ConfigService::$tablePermissions.'.name', $permissions);
        });

        //get contents based on ids
        $fieldsWithContent = $fieldsWithContent
            ->whereIn(ConfigService::$tableContent.'.id', $ids)
            ->get();

        return $this->parseAndGetLinkedContent($fieldsWithContent);
    }

    /**
     *
     * If the parent id is null it will pull all rows with that slug under ANY parent including null
     *
     * @param $slug
     * @param $parentId
     * @return array
     */
    public function getBySlug($slug, $parentId = null)
    {
        $fieldsWithContent = $this->queryIndex()
            ->where(ConfigService::$tableContent.'.slug', $slug);

        if(!is_null($parentId)) {
            $fieldsWithContent = $fieldsWithContent->where('parent_id', $parentId);
        }

        $fieldsWithContent = $fieldsWithContent->get();

        return $this->parseAndGetLinkedContent($fieldsWithContent);
    }

    /**
     * @param int $page
     * @param int $amount
     * @param string $orderByDirection
     * @param string $orderByColumn
     * @param array $statues
     * @param array $types
     * @param array $requiredFields
     * @param int|null $parentId
     * @param bool $includeFuturePublishedOn
     * @return array
     */
    public function getPaginated(
        $page,
        $amount,
        $orderByDirection = 'desc',
        $orderByColumn = 'published_on',
        array $statues = [],
        array $types = [],
        array $requiredFields = [],
        $parentId = null,
        $includeFuturePublishedOn = false
    )
    {
        $page--;

        //get permissions from requests or empty array
        $permissions = request()->request->get('permissions') ?? [];

        $fieldsWithContent = $this->queryIndex()
            ->whereIn(ConfigService::$tableContent.'.status', $statues)
            ->whereIn(ConfigService::$tableContent.'.type', $types);

        if(!is_null($parentId)) {
            $fieldsWithContent =
                $fieldsWithContent->where(ConfigService::$tableContent.'.parent_id', $parentId);
        }


        foreach($requiredFields as $requiredKeys => $requiredValues) {
            //join with field table where key and value are the searched value
            $fieldsWithContent->leftJoin(
                ConfigService::$tableFields.' as field'.$requiredKeys,
                function($join) use ($requiredKeys, $requiredValues) {
                    $join
                        ->where('field'.$requiredKeys.'.key', $requiredKeys)
                        ->where(function($builder) use ($requiredKeys, $requiredValues) {
                            return $builder->where('field'.$requiredKeys.'.value', $requiredValues)
                                ->orWhere('field'.$requiredKeys.'.type', 'content_id');
                        }
                        );
                }
            );

            //linked content fields
            $fieldsWithContent->leftJoin(
                ConfigService::$tableContentFields.' as contentfield'.$requiredKeys,
                function($join) use ($requiredKeys) {
                    $join->on('contentfield'.$requiredKeys.'.content_id', '=', ConfigService::$tableContent.'.id')
                        ->on('contentfield'.$requiredKeys.'.field_id', 'field'.$requiredKeys.'.id');
                }
            );

            //linked parent fields
            $fieldsWithContent->leftJoin(
                ConfigService::$tableContentFields.' as parentfield'.$requiredKeys,
                function($join) use ($requiredKeys) {
                    $join->on('parentfield'.$requiredKeys.'.content_id', '=', ConfigService::$tableContent.'.parent_id')
                        ->on('parentfield'.$requiredKeys.'.field_id', '=', 'field'.$requiredKeys.'.id');
                }
            );

            //join with content for fields with content_id type
            $fieldsWithContent->leftJoin(
                ConfigService::$tableContent.' as fieldcontent'.$requiredKeys,
                function($join) use ($requiredKeys, $requiredValues) {
                    $join->on('fieldcontent'.$requiredKeys.'.id', '=', 'field'.$requiredKeys.'.value')
                        ->where(function($builder) use ($requiredKeys) {
                            return $builder->whereNotNull('contentfield'.$requiredKeys.'.id')->orWhereNotNull('parentfield'.$requiredKeys.'.id');
                        })
                        ->where('fieldcontent'.$requiredKeys.'.slug', $requiredValues);
                });

            //where conditions
            $fieldsWithContent = $fieldsWithContent->where(function($builder) use ($requiredKeys) {
                return $builder->whereNotNull('fieldcontent'.$requiredKeys.'.id')
                    ->orWhere(function($builder) use ($requiredKeys) {
                        return $builder->where('field'.$requiredKeys.'.type', '<>', 'content_id')
                            ->where(function($builder) use ($requiredKeys) {
                                return $builder->whereNotNull('contentfield'.$requiredKeys.'.id')
                                    ->orWhereNotNull('parentfield'.$requiredKeys.'.id');
                            });
                    });
            });
        }

        //check if use have permission to view the content
        $fieldsWithContent->where(function($builder) use ($permissions) {
            return $builder->whereNull(ConfigService::$tablePermissions.'.name')
                ->orWhereIn(ConfigService::$tablePermissions.'.name', $permissions);
        });


        if(!$includeFuturePublishedOn) {
            $fieldsWithContent = $fieldsWithContent->where(
                function(Builder $builder) {
                    return $builder->where(
                        ConfigService::$tableContent.'.published_on',
                        '<',
                        Carbon::now()->toDateTimeString()
                    )
                        ->orWhereNull(ConfigService::$tableContent.'.published_on');
                }
            );
        }

        $fieldsWithContent = $fieldsWithContent->orderBy($orderByColumn, $orderByDirection)
            ->skip($page * $amount)
            ->limit($amount)
            ->get();

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

        $contentId = $this->queryTable()->insertGetId(
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

        $this->reposition($contentId, $position);

        return $contentId;
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
    )
    {
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

        $this->reposition($id, $position);

        return $id;
    }

    /**
     * @param int $id
     * @param bool $deleteChildren
     * @return int
     */
    public function delete($id, $deleteChildren = false)
    {
        $content = $this->getById($id);

        // unlink fields and data
        $this->unlinkField($id);
        $this->unlinkDatum($id);

        if($deleteChildren) {
            // unlink children content
            $this->unlinkChildren($id);
        }

        $delete = $this->queryTable()->where('id', $id)->delete();

        $this->otherChildrenRepositions($content['parent_id'], $id, 0);

        return $delete;
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
        if(!is_null($fieldId)) {
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
        if(!is_null($datumId)) {
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
     * Insert a new record in railcontent_content_data
     * @param integer $contentId
     * @param integer $datumId
     * @return int
     */
    public function linkDatum($contentId, $datumId)
    {
        return $this->contentDataQuery()->insertGetId(
            [
                'content_id' => $contentId,
                'datum_id' => $datumId
            ]);
    }

    /**
     * Insert a new record in railcontent_content_fields
     * @param integer $contentId
     * @param integer $fieldId
     * @return int
     */
    public function linkField($contentId, $fieldId)
    {
        return $this->contentFieldsQuery()->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $fieldId
            ]);
    }

    /**
     * Get the content and the linked datum from database
     * @param integer $datumId
     * @param integer $contentId
     */
    public function getLinkedDatum($datumId, $contentId)
    {
        $dataIdLabel = ConfigService::$tableData.'.id';

        return $this->contentDataQuery()
            ->leftJoin(ConfigService::$tableData, 'datum_id', '=', $dataIdLabel)
            ->where(
                [
                    'datum_id' => $datumId,
                    'content_id' => $contentId
                ]
            )->get()->first();
    }

    /**
     * Get the content and the associated field from database
     * @param integer $fieldId
     * @param integer $contentId
     */
    public function getLinkedField($fieldId, $contentId)
    {
        $fieldIdLabel = ConfigService::$tableFields.'.id';

        return $this->contentFieldsQuery()
            ->leftJoin(ConfigService::$tableFields, 'field_id', '=', $fieldIdLabel)
            ->where(
                [
                    'field_id' => $fieldId,
                    'content_id' => $contentId
                ]
            )->get()->first();
    }

    /**
     * Get the content and the associated field from database based on key
     * @param string $key
     * @param integer $contentId
     */
    public function getContentLinkedFieldByKey($key, $contentId)
    {
        $fieldIdLabel = ConfigService::$tableFields.'.id';

        return $this->contentFieldsQuery()
            ->leftJoin(ConfigService::$tableFields, 'field_id', '=', $fieldIdLabel)
            ->where(
                [
                    'key' => $key,
                    'content_id' => $contentId
                ]
            )->get()->first();
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
                    ConfigService::$tableContent.'.id as id',
                    ConfigService::$tableContent.'.slug as slug',
                    ConfigService::$tableContent.'.status as status',
                    ConfigService::$tableContent.'.type as type',
                    ConfigService::$tableContent.'.position as position',
                    ConfigService::$tableContent.'.parent_id as parent_id',
                    ConfigService::$tableContent.'.published_on as published_on',
                    ConfigService::$tableContent.'.created_on as created_on',
                    ConfigService::$tableContent.'.archived_on as archived_on',
                    'allfieldsvalue.id as field_id',
                    'allfieldsvalue.key as field_key',
                    'allfieldsvalue.value as field_value',
                    'allfieldsvalue.type as field_type',
                    'allfieldsvalue.position as field_position',
                    ConfigService::$tableData.'.id as datum_id',
                    ConfigService::$tableData.'.key as datum_key',
                    ConfigService::$tableData.'.value as datum_value',
                    ConfigService::$tableData.'.position as datum_position',

                ]
            )
            ->leftJoin(
                ConfigService::$tableContentData,
                ConfigService::$tableContentData.'.content_id',
                '=',
                ConfigService::$tableContent.'.id'
            )
            ->leftJoin(
                ConfigService::$tableData,
                ConfigService::$tableData.'.id',
                '=',
                ConfigService::$tableContentData.'.datum_id'
            )
            ->leftJoin(
                ConfigService::$tableContentFields.' as allcontentfields',
                'allcontentfields.content_id',
                '=',
                ConfigService::$tableContent.'.id'
            )
            ->leftJoin(
                ConfigService::$tableFields.' as allfieldsvalue',
                'allfieldsvalue.id',
                '=',
                'allcontentfields.field_id'
            )
            ->leftJoin(
                ConfigService::$tableContentPermissions, function($join) {
                return $join->on(ConfigService::$tableContentPermissions.'.content_id', ConfigService::$tableContent.'.id')
                    ->orOn(ConfigService::$tableContentPermissions.'.content_type', ConfigService::$tableContent.'.type');
            }
            )
            ->leftJoin(
                ConfigService::$tablePermissions,
                ConfigService::$tablePermissions.'.id',
                '=',
                ConfigService::$tableContentPermissions.'.required_permission_id'
            )
            ->groupBy([
                'allfieldsvalue.id',
                ConfigService::$tableContent.'.id',
                ConfigService::$tableData.'.id'
            ]);
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
     * @return Builder
     */
    public function contentVersionQuery()
    {
        return parent::connection()->table(ConfigService::$tableVersions);
    }

    /**
     * @param $fieldsWithContent
     * @return array
     */
    private function parseAndGetLinkedContent($fieldsWithContent)
    {
        $permissions = request()->request->get('permissions') ?? [];

        $linkedContentIdsToGrab = [];

        foreach($fieldsWithContent as $fieldWithContent) {
            if($fieldWithContent['field_type'] === 'content_id') {
                $linkedContentIdsToGrab[] = $fieldWithContent['field_value'];
            }
        }

        $linkedContents = [];

        if(!empty($linkedContentIdsToGrab)) {
            $linkedContents = $this->getManyById($linkedContentIdsToGrab, $permissions);
        }

        $content = [];

        foreach($fieldsWithContent as $fieldWithContent) {
            $content[$fieldWithContent['id']] = [
                'id' => $fieldWithContent['id'],
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

        foreach($fieldsWithContent as $fieldWithContent) {
            if(($fieldWithContent['field_key'] === null) && ($fieldWithContent['datum_key'] === null)) {
                continue;
            }

            if($fieldWithContent['field_type'] === 'content_id') {

                $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']] = [
                    'id' => $linkedContents[$fieldWithContent['field_value']]['id'],
                    'slug' => $linkedContents[$fieldWithContent['field_value']]['slug'],
                    'status' => $linkedContents[$fieldWithContent['field_value']]['status'],
                    'type' => $linkedContents[$fieldWithContent['field_value']]['type'],
                    'position' => $linkedContents[$fieldWithContent['field_value']]['position'],
                    'parent_id' => $linkedContents[$fieldWithContent['field_value']]['parent_id'],
                    'published_on' => $linkedContents[$fieldWithContent['field_value']]['published_on'],
                    'created_on' => $linkedContents[$fieldWithContent['field_value']]['created_on'],
                    'archived_on' => $linkedContents[$fieldWithContent['field_value']]['archived_on'],
                ];

                if(array_key_exists('fields', $linkedContents[$fieldWithContent['field_value']])) {
                    foreach($linkedContents[$fieldWithContent['field_value']]['fields'] as
                            $linkedContentFieldKey => $linkedContentFieldValue) {

                        $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']]
                        ['fields'][$linkedContentFieldKey] = $linkedContentFieldValue;
                    }
                }

                if(array_key_exists('datum', $linkedContents[$fieldWithContent['field_value']])) {
                    foreach($linkedContents[$fieldWithContent['field_value']]['datum'] as
                            $linkedContentDatumKey => $linkedContentDatumValue) {

                        $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']]
                        ['datum'][$linkedContentDatumKey] = $linkedContentDatumValue;
                    }
                }

            } else {
                // put multiple fields with same key in to an array
                if($fieldWithContent['field_type'] == 'multiple') {

                    $content[$fieldWithContent['id']]
                    ['fields']
                    [$fieldWithContent['field_key']]
                    [$fieldWithContent['field_position']] =
                        $fieldWithContent['field_value'];

                } elseif($fieldWithContent['field_value']) {

                    $content[$fieldWithContent['id']]
                    ['fields']
                    [$fieldWithContent['field_key']] =
                        $fieldWithContent['field_value'];
                }
            }

            //put datum as array key => value
            if($fieldWithContent['datum_value']) {
                $content[$fieldWithContent['id']]
                ['datum']
                [$fieldWithContent['datum_key']] =
                    $fieldWithContent['datum_value'];
            }
        }

        return $content;
    }

    /**
     * Update content position and call function that recalculate position for other children
     * @param int $contentId
     * @param int $position
     */
    public function reposition($contentId, $position)
    {
        $parentContentId = $this->queryTable()->where('id', $contentId)->first(['parent_id'])['parent_id']
            ?? null;
        $childContentCount = $this->queryTable()->where('parent_id', $parentContentId)->count();

        if($position < 1) {
            $position = 1;
        } elseif($position > $childContentCount) {
            $position = $childContentCount;
        }

        $this->transaction(
            function() use ($contentId, $position, $parentContentId) {
                $this->queryTable()
                    ->where('id', $contentId)
                    ->update(
                        ['position' => $position]
                    );

                $this->otherChildrenRepositions($parentContentId, $contentId, $position);
            }
        );
    }

    /** Update position for other categories with the same parent id
     * @param integer $parentCategoryId
     * @param integer $categoryId
     * @param integer $position
     */
    function otherChildrenRepositions($parentContentId, $contentId, $position)
    {
        $childContent =
            $this->queryTable()
                ->where('parent_id', $parentContentId)
                ->where('id', '<>', $contentId)
                ->orderBy('position')
                ->get()
                ->toArray();

        $start = 1;

        foreach($childContent as $child) {
            if($start == $position) {
                $start++;
            }

            $this->queryTable()
                ->where('id', $child['id'])
                ->update(
                    ['position' => $start]
                );
            $start++;
        }
    }

    /**
     * Get all contents order by parent and position
     * @return array
     */
    public function getAllContents()
    {
        return $this->queryIndex()->orderBy('parent_id', 'asc')->orderBy('position', 'asc')->get()->toArray();
    }

    /**
     * Get a collection with the contents Ids, where the content it's linked
     * @param integer $contentId
     * @return \Illuminate\Support\Collection
     */
    public function linkedWithContent($contentId)
    {
        $fieldIdLabel = ConfigService::$tableFields.'.id';

        return $this->contentFieldsQuery()
            ->select('content_id')
            ->leftJoin(ConfigService::$tableFields, 'field_id', '=', $fieldIdLabel)
            ->where(
                [
                    'value' => $contentId,
                    'type' => 'content_id'
                ]
            )->get();
    }
}