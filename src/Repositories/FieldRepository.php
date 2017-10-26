<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class FieldRepository extends RepositoryBase
{
    /**
     * Update or insert a new record in the railcontent_fields table
     *
     * @param integer $id
     * @param string $key
     * @param string $value
     * @param string $type
     * @param int $position
     * @return int
     */
    public function updateOrCreateField($id, $key, $value, $type, $position)
    {
        $existing = $this->query()->where(
            [
                'key' => $key,
                'value' => $value,
                'type' => $type,
                'position' => $position
            ]
        )->first();

        if (empty($existing)) {
            return $this->query()->insertGetId(
                [
                    'key' => $key,
                    'value' => $value,
                    'type' => $type,
                    'position' => $position
                ]
            );
        } else {
            $update = $this->query()->where(['id' => $existing['id']])->update(
                [
                    'key' => $key,
                    'value' => $value,
                    'type' => $type,
                    'position' => $position
                ]
            );
        }

        return $existing['id'];
    }

    /**
     * Insert a new record in railcontent_content_fields
     *
     * @param integer $contentId
     * @param integer $fieldId
     * @return int
     */
    public function linkFieldToContent($contentId, $fieldId)
    {
        return $this->queryContentFields()->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $fieldId
            ]
        );
    }

    /**
     * Delete a record from railcontent_fields table
     *
     * @param integer $id
     * @return int
     */
    public function deleteField($id)
    {
        return $this->query()->where(
            [
                'id' => $id
            ]
        )->delete();
    }

    /** Get field from database based on key and value pair
     *
     * @param string $key
     * @param string $value
     * @return array
     */
    public function getFieldByKeyAndValue($key, $value)
    {
        $builder = $this->query();

        return $builder
            ->select(
                ConfigService::$tableFields . '.*',
                'translation_' . ConfigService::$tableFields . '.value as translate_value'
            )
            ->where(['key' => $key, 'translate_value' => $value])->get()->first();
    }

    /**
     * Get the content and the associated field from database
     *
     * @param integer $fieldId
     * @param integer $contentId
     * @return mixed
     */
    public function getLinkedField($fieldId, $contentId)
    {
        return $this->query()
            ->leftJoin(
                ConfigService::$tableContentFields,
                'field_id',
                '=',
                ConfigService::$tableFields . '.id'
            )
            ->select(
                ConfigService::$tableContentFields . '.*',
                ConfigService::$tableFields . '.*'
            )
            ->where(
                [
                    'field_id' => $fieldId,
                    'content_id' => $contentId
                ]
            )
            ->get()
            ->first();
    }

    /**
     * Unlink all fields for a content id.
     *
     * @param $contentId
     * @return int
     */
    public function unlinkContentFields($contentId)
    {
        return $this->query()->where('content_id', $contentId)->delete();
    }

    /**
     * Delete a specific content field link
     *
     * @param $contentId
     * @param null $fieldId
     * @return int
     */
    public function unlinkContentField($contentId, $fieldId)
    {
        return $this->query()
            ->where('content_id', $contentId)
            ->where('field_id', $fieldId)
            ->delete();
    }

    /** Generate the query builder
     *
     * @return Builder
     */
    public function attachFieldsToContentQuery(Builder $query)
    {
        // todo: this database logic should be in the content repository
        //get fields from requests or empty array
//        $fields = request()->fields ?? [];
//
//        foreach($fields as $requiredKeys => $requiredValues) {
//            //get the field from tableFields
//            $query->leftJoin(
//                ConfigService::$tableFields.' as field'.$requiredKeys,
//                function($join) use ($requiredKeys, $requiredValues) {
//                    $join->on('field'.$requiredKeys.'.id', 'searched_field'.$requiredKeys.'.entity_id')
//                        ->orWhere(function($join) use ($requiredKeys) {
//                            $join->where('field'.$requiredKeys.'.type', 'content_id')
//                                ->on('field'.$requiredKeys.'.value', 'searched_field'.$requiredKeys.'.entity_id');
//                        });
//                }
//            );
//
//            //get the link between content or content parent and the field
//            $query->leftJoin(ConfigService::$tableContentFields.' as incontentfield'.$requiredKeys, function($join) use ($requiredKeys) {
//                return $join->on('incontentfield'.$requiredKeys.'.field_id', 'field'.$requiredKeys.'.id')
//                    ->on('incontentfield'.$requiredKeys.'.content_id', ConfigService::$tableContent.'.parent_id')
//                    ->orOn('incontentfield'.$requiredKeys.'.content_id', ConfigService::$tableContent.'.id');
//            });
//
//            $query->addSelect('incontentfield'.$requiredKeys.'.content_id as incontent'.$requiredKeys.'_content_id');
//
//            $query->where(function($builder) use ($requiredKeys, $requiredValues) {
//                $builder->whereNotNull('incontentfield'.$requiredKeys.'.id');
//            }
//            );
//        }

        return $query
            ->leftJoin(
                ConfigService::$tableContentFields . ' as allcontentfields',
                'allcontentfields.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->leftJoin(
                ConfigService::$tableFields,
                ConfigService::$tableFields . '.id',
                '=',
                'allcontentfields.field_id'
            );
    }


    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()->table(ConfigService::$tableFields);
    }

    /**
     * @return Builder
     */
    public function queryContentFields()
    {
        return $this->connection()->table(ConfigService::$tableContentFields);
    }
}