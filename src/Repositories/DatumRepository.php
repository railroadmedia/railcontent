<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class DatumRepository extends RepositoryBase
{
    /**
     * Update or insert a new record in railcontent_data table
     * @param integer $id
     * @param string $key
     * @param string $value
     * @param integer $position
     * @return int
     */
    public function updateOrCreateDatum($id, $key, $value, $position)
    {
        $update = $this->query()->where(ConfigService::$tableData.'.id', $id)->update(
            [
                'key' => $key,
                'position' => $position
            ]
        );

        if(!$update) {
            $id = $this->query()->insertGetId(
                [
                    'key' => $key,
                    'position' => $position
                ]
            );
        }

        $this->saveTranslation(
            [
                'entity_type' => ConfigService::$tableData,
                'entity_id' => $id,
                'value' => $value
            ]
        );

        return $id;
    }

    /**
     * Delete a record from railcontent_data table
     * @param integer $id
     * @return bool
     */
    public function deleteDatum($id)
    {

        $this->deleteTranslations(
            [
                'entity_type' => ConfigService::$tableData,
                'entity_id' => $id
            ]
        );

        return $this->query()->where([
                'id' => $id
            ]
        )->delete();
    }

    public function getDatumByKeyAndValue($key, $value)
    {
        return $this->query()->where(['key' => $key, 'value' => $value])->get()->first();
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableData);
    }
}