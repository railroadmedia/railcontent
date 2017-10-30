<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class DatumRepository extends RepositoryBase
{
    /**
     * Update or insert a new record in railcontent_data table
     *
     * @param integer $id
     * @param string $key
     * @param string $value
     * @param integer $position
     * @return int
     */
    public function updateOrCreateDatum($id, $key, $value, $position)
    {
        $update = $this->query()->where(ConfigService::$tableData . '.id', $id)->update(
            [
                'key' => $key,
                'value' => $value,
                'position' => $position
            ]
        );

        if (!$update) {
            $id = $this->query()->insertGetId(
                [
                    'key' => $key,
                    'value' => $value,
                    'position' => $position
                ]
            );
        }

        return $id;
    }

    /**
     * Insert a new record in railcontent_content_data
     *
     * @param integer $contentId
     * @param integer $datumId
     * @return int
     */
    public function linkContentToDatum($contentId, $datumId)
    {
        return $this->contentDatumQuery()->insertGetId(
            [
                'content_id' => $contentId,
                'datum_id' => $datumId
            ]
        );
    }


    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()->table(ConfigService::$tableData);
    }

    /**
     * @return Builder
     */
    public function contentDatumQuery()
    {
        return $this->connection()->table(ConfigService::$tableContentData);
    }

    /**
     * Delete a record from railcontent_data table
     *
     * @param integer $id
     * @return bool
     */
    public function deleteDatum($id)
    {
        return $this->query()->where(
            [
                'id' => $id
            ]
        )->delete();
    }

    /** Get datum details based on key and value
     *
     * @param string $key
     * @param string $value
     * @return array
     */
    public function getDatumByKeyAndValue($key, $value)
    {
        $builder = $this->query();

        return $builder
            ->select(
                ConfigService::$tableData . '.*',
                'translation_' . ConfigService::$tableData . '.value as value'
            )
            ->where(['key' => $key, 'value' => $value])->get()->first();
    }

    /**
     * Unlink all datum for a content id.
     *
     * @param $contentId
     * @return int
     */
    public function unlinkContentData($contentId)
    {
        // todo: move to data repository

        return $this->query()->where('content_id', $contentId)->delete();
    }

    /**
     * Delete a specific content datum link
     *
     * @param $contentId
     * @param null $datumId
     * @return int
     */
    public function unlinkContentDatum($contentId, $datumId)
    {
        // todo: move to data repository

        return $this->query()
            ->where('content_id', $contentId)
            ->where('datum_id', $datumId)
            ->delete();
    }


    /**
     * @param Builder $query
     * @return Builder
     */
    public function attachDatumToContentQuery(Builder $query)
    {
        return $query
            ->leftJoin(
                ConfigService::$tableContentData,
                ConfigService::$tableContentData . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->leftJoin(
                ConfigService::$tableData,
                ConfigService::$tableData . '.id',
                '=',
                ConfigService::$tableContentData . '.datum_id'
            );
    }
}