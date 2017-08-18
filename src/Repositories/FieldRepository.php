<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ConfigService;

class FieldRepository extends RepositoryBase
{
    /**
     * Update or insert a new record in the railcontent_fields table
     * @param integer $id
     * @param string $key
     * @param string $value
     * @return int
     */
    public function updateOrCreateField($id, $key, $value)
    {
        $update = $this->query()->where('id', $id)->update(
            [
                'key' => $key,
                'value' => $value,
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        );

        if(!$update){
            $id = $this->query()->insertGetId(
                [
                    'key' => $key,
                    'value' => $value,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]
            );
        }

        return $id;
    }

    /**
     * Delete a record from railcontent_fields table
     * @param integer $id
     */
    public function deleteField($id)
    {
        return $this->query()->where([
                'id' => $id
            ]
        )->delete();
    }

    /**
     * Insert a new record in railcontent_subject_fields table
     * @param integer $fieldId
     * @param integer $categoryId
     * @param string $subjectType
     * @return int
     */
    public function linkSubjectField($fieldId, $categoryId, $subjectType)
    {
        $categoryFieldId =  $this->subjectFieldsQuery()->insertGetId(
            [
                'subject_id' => $categoryId,
                'subject_type' => $subjectType,
                'field_id' => $fieldId,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

        return $categoryFieldId;
    }

    /**
     * Delete the links between category and associated fields
     * @param $categoryId
     */
    public function unlinkCategoryFields ($categoryId)
    {
        return $this->subjectFieldsQuery()->where(
            [
                'subject_id' => $categoryId,
                'subject_type' => ConfigService::$subjectTypeCategory
            ]
        )->delete();
    }

    /**
     * Get the category and the field data from database
     * @param integer $fieldId
     * @return mixed
     */
    public function getSubjectField($fieldId, $categoryId)
    {
        $fieldIdLabel = ConfigService::$tableFields.'.id';

        return $this->subjectFieldsQuery()
            ->leftJoin(ConfigService::$tableFields,'field_id','=',$fieldIdLabel)
            ->where(
                [
                    'field_id' => $fieldId,
                    'subject_id' => $categoryId,
                    'subject_type' => ConfigService::$subjectTypeCategory
                ]
            )->get()->first();
    }

    /**
     * Get all category linked fields data
     * @param integer $categoryId
     * @return array
     */
    public function getCategoryFields($categoryId)
    {
        $fieldIdLabel = ConfigService::$tableFields.'.id';

        return $this->subjectFieldsQuery()
            ->leftJoin(ConfigService::$tableFields,'field_id','=',$fieldIdLabel)
            ->where(
                [
                    'subject_id' => $categoryId,
                    'subject_type' => ConfigService::$subjectTypeCategory
                ]
            )->get()->toArray();
    }

    /**
     * Delete the link between category and field
     * @param integer $fieldId
     * @param integer $categoryId
     * @return int
     */
    public function unlinkCategoryField($fieldId, $categoryId)
    {
        return $this->subjectFieldsQuery()->where(
            [
                'subject_id' => $categoryId,
                'subject_type' => ConfigService::$subjectTypeCategory,
                'field_id' => $fieldId
            ]
        )->delete();
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableFields);
    }

    /**
     * @return Builder
     */
    public function subjectFieldsQuery()
    {
        return parent::connection()->table(ConfigService::$tableContentFields);
    }
}