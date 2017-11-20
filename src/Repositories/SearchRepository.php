<?php

namespace Railroad\Railcontent\Repositories;


use Carbon\Carbon;

use Railroad\Railcontent\Services\ConfigService;


class SearchRepository extends RepositoryBase
{

    /**
     * @return mixed
     */
    protected function query()
    {
        return parent::connection()->table(ConfigService::$tableSearchIndexes);
    }

    public function createSearchIndexes($contents)
    {
        $searchInsertData = [];

        //truncate old indexes
        $this->truncateOldIndexes();

        $searchIndexValues = ConfigService::$searchIndexValues;

        //insert new indexes in the DB
        foreach ($contents as $content)
        {
            $searchInsertData = [
                'content_id' => $content['id'],
                'high_value' =>  $this->prepareIndexesValues($searchIndexValues['high_value'], $content),
                'medium_value' => $this->prepareIndexesValues($searchIndexValues['medium_value'], $content),
                'low_value' => $this->prepareIndexesValues($searchIndexValues['low_value'], $content),
                'created_at' => Carbon::parse($content['created_on'])
                    ->toDateTimeString()
            ];
            $this->create($searchInsertData);
        }

    }

    private function truncateOldIndexes()
    {
        return $this->query()->truncate();
    }

    private function prepareIndexesValues($configSearchIndexValues, $content){
        $value = '';

        foreach($configSearchIndexValues['content_attributes'] as $contentAttribute){
            $value .= $content["$contentAttribute"].' ';
        }

        $contentFieldKeys =(array_column($content['fields'], 'key'));
        foreach($contentFieldKeys as $key=>$fieldKeyValue){
            if(in_array($fieldKeyValue, $configSearchIndexValues['field_keys'])) {
                $value .= $content['fields'][$key]['value'].' ';
            }
        }

        return $value;
    }


}