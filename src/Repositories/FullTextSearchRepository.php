<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\FullTextSearchQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;

class FullTextSearchRepository extends RepositoryBase
{
    use RefreshDatabase;
    private $contentRepository;

    /**
     * ContentRepository constructor.
     *
     * @param ContentRepository $contentRepository
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        ContentRepository $contentRepository
    ) {
        parent::__construct();

        $this->contentRepository = $contentRepository;
    }

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

        //delete old indexes
        $this->deleteOldIndexes();

        $searchIndexValues = ConfigService::$searchIndexValues;

        //insert new indexes in the DB
        foreach ($contents as $content) {
            $searchInsertData = [
                'content_id' => $content['id'],
                'high_value' => $this->prepareIndexesValues($searchIndexValues['high_value'], $content),
                'medium_value' => $this->prepareIndexesValues($searchIndexValues['medium_value'], $content),
                'low_value' => $this->prepareIndexesValues($searchIndexValues['low_value'], $content),
                'brand' => ConfigService::$brand,
                'content_type' => $content['type'],
                'content_published_on' => $content['published_on'],
                'created_at' => Carbon::now()->toDateTimeString()
            ];

            $this->create($searchInsertData);
        }

    }

    /** Delete old indexes for the brand
     *
     * @return mixed
     */
    private function deleteOldIndexes()
    {
        return $this->query()->where('brand', ConfigService::$brand)->delete();
    }

    /** Prepare search indexes based on config settings
     *
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
                    $values = array_merge(
                        $values,
                        ContentHelper::getFieldSubContentValues(
                            $content,
                            $conff[0],
                            $conff[1]
                        )
                    );
                } else {
                    if (count($conff) == 1) {
                        $values = array_merge($values, ContentHelper::getFieldValues($content, $conff[0]));
                    }
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

    /** Perform a boolean full text search by term, paginate and order the results by score.
     * Returns an array with the contents that contain the search criteria
     *
     * @param string|null $term
     * @param int $page
     * @param int $limit
     * @param null $contentType
     * @return array
     */
    public function search(
        $term,
        $page = 1,
        $limit = 10,
        $contentType = null,
        $dateTimeCutoff = null
    ) {
        $query = $this->query()
            ->selectColumns($term)
            ->restrictBrand()
            ->restrictByTerm($term)
            ->orderByScore()
            ->directPaginate($page, $limit);

        if (!empty($contentType)) {
            $query->where('content_type', $contentType);
        }

        if (!empty($dateCutoff)) {
            $query->where('content_published_on', '>', $dateTimeCutoff);
        }

        $contentRows = $query->getToArray();

        return $this->contentRepository->getByIds(array_column($contentRows, 'content_id'));

    }

    /** Count all the matches
     *
     * @param string|null $term
     * @param null $contentType
     * @return int
     */
    public function countTotalResults($term, $contentType = null, $dateTimeCutoff = null)
    {
        $query = $this->query()
            ->selectColumns($term)
            ->restrictByTerm($term)
            ->restrictBrand();

        if (!empty($contentType)) {
            $query->where('content_type', $contentType);
        }

        if (!empty($dateCutoff)) {
            $query->where('content_published_on', '>', $dateTimeCutoff);
        }

        return $query->count();
    }
}