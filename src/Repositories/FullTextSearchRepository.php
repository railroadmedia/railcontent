<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\FullTextSearchQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;


class FullTextSearchRepository extends RepositoryBase
{
    /**
     * @return FullTextSearchQueryBuilder
     */
    protected function query()
    {
        return (new FullTextSearchQueryBuilder(
            $this->connection(),
            $this->connection()->getQueryGrammar(),
            $this->connection()->getPostProcessor()
        ))
            ->from(ConfigService::$tableSearchIndexes);
    }

    public function createSearchIndexes($contents)
    {
        $searchInsertData = [];

        //truncate old indexes
        $this->truncateOldIndexes();

        $searchIndexValues = ConfigService::$searchIndexValues;

        //insert new indexes in the DB
        foreach ($contents as $content) {
            $searchInsertData = [
                'content_id' => $content['id'],
                'high_value' => $this->prepareIndexesValues($searchIndexValues['high_value'], $content),
                'medium_value' => $this->prepareIndexesValues($searchIndexValues['medium_value'], $content),
                'low_value' => $this->prepareIndexesValues($searchIndexValues['low_value'], $content),
                'created_at' => Carbon::parse($content['created_on'])
                    ->toDateTimeString()
            ];
            $this->create($searchInsertData);
        }

    }

    /** Truncate old indexes
     * @return mixed
     */
    private function truncateOldIndexes()
    {
        return $this->query()->truncate();
    }

    /** Prepare search indexes based on config settings
     * @param array $configSearchIndexValues
     * @param array $content
     * @return string
     */
    private function prepareIndexesValues($configSearchIndexValues, $content)
    {
        $values = [];

        foreach ($configSearchIndexValues['content_attributes'] as $contentAttribute) {
            $values[] = $content["$contentAttribute"];
        }

        if (in_array('*', $configSearchIndexValues['field_keys'])) {
            foreach ($content['fields'] as $field) {
                if (!is_array($field['value'])) {
                    $values[] = $field['value'];
                }
            }
        } else {
            foreach ($configSearchIndexValues['field_keys'] as $fieldKey) {
                $conff = explode(':', $fieldKey);
                if (count($conff) == 2) {
                    $values = array_merge($values, ContentHelper::getFieldSubContentValues($content, $conff[0], $conff[1]));
                } else if (count($conff) == 1) {
                    $values = array_merge($values, ContentHelper::getFieldValues($content, $conff[0]));
                }
            }
        }

        if (in_array('*', $configSearchIndexValues['data_keys'])) {
            foreach ($content['data'] as $data) {
                $values[] = $data['value'];
            }
        } else {
            foreach ($configSearchIndexValues['data_keys'] as $dataKey) {
                $values = array_merge($values, ContentHelper::getDatumValues($content, $dataKey));
            }
        }
        return implode(' ', $values);
    }

    public function search(
        $term,
        $page = 1,
        $limit = 10
    ) {

        $query = $this->query()
            ->selectColumns($term)
            ->restrictByTerm($term)
            ->orderByRaw('(high_score + medium_score + low_score) DESC')
            ->limit($limit)
            ->offset($page);

        return $query->get()->toArray();
    }

    public function getAll()
    {
        return $this->query()->get()->toArray();
    }
}