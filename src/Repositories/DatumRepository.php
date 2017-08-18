<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ConfigService;

class DatumRepository extends RepositoryBase
{
    /**
     * Update or insert a new record in railcontent_data table
     * @param integer $id
     * @param string $key
     * @param text $value
     * @return int
     */
    public function updateOrCreateDatum($id, $key, $value)
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
     * Delete a record from railcontent_data table
     * @param integer $id
     * @return bool
     */
    public function deleteDatum($id)
    {
        return $this->query()->where([
                'id' => $id
            ]
        )->delete();
    }

    /**
     * Insert a new record in railcontent_subject_data
     * @param $dataId
     * @param $subjectId
     * @param $subjectType
     * @return int
     */
    public function linkSubjectDatum($dataId, $subjectId, $subjectType)
    {
        return $categoryDataId =  $this->subjectDataQuery()->insertGetId(
            [
                'subject_id' => $subjectId,
                'subject_type' => $subjectType,
                'data_id' => $dataId,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
    }

    /**
     * Delete the link between category and datum
     * @param integer $subjectId
     * @param integer $dataId
     * @param string $subjectType
     */
    public function unlinkSubjectDatum ($dataId, $subjectId, $subjectType)
    {
        return $this->subjectDataQuery()->where(
            [
                'subject_id' => $subjectId,
                'subject_type' => $subjectType,
                'data_id' =>$dataId
            ]
        )->delete();
    }

    /**
     * Delete the subject datum
     * @param integer $subjectId
     * @param string $subjectType
     */
    public function unlinkAllSubjectDatum ($subjectId, $subjectType)
    {
        return $this->subjectDataQuery()->where(
            [
                'subject_id' => $subjectId,
                'subject_type' => $subjectType
            ]
        )->delete();
    }

    /**
     * Get the category and the linked datum from database
     * @param integer $dataId
     * @param integer $subjectId
     * @param string $subjectType
     */
    public function getSubjectDatum($dataId, $subjectId, $subjectType)
    {
        $dataIdLabel = ConfigService::$tableData.'.id';

        return $this->subjectDataQuery()
            ->leftJoin(ConfigService::$tableData,'data_id','=',$dataIdLabel)
            ->where(
                [
                    'data_id' => $dataId,
                    'subject_id' => $subjectId,
                    'subject_type' => $subjectType
                ]
            )->get()->first();
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableData);
    }

    /**
     * @return Builder
     */
    public function subjectDataQuery()
    {
        return parent::connection()->table(ConfigService::$tableSubjectData);
    }

}