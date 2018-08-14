<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Repositories\QueryBuilders\FullTextSearchQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;
use Illuminate\Support\Facades\DB;

class FullTextSearchRepository extends RepositoryBase
{
    use RefreshDatabase;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var ContentFieldRepository
     */
    private $fieldRepository;

    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;

    /**
     * ContentRepository constructor.
     *
     * @param ContentRepository $contentRepository
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        ContentRepository $contentRepository,
        ContentFieldRepository $fieldRepository,
        ContentDatumRepository $datumRepository
    ) {
        parent::__construct();

        $this->contentRepository = $contentRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
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

    /**
     * @return ContentQueryBuilder
     */
    protected function contentQuery()
    {
        return (new ContentQueryBuilder(
            $this->connection(),
            $this->connection()->getQueryGrammar(),
            $this->connection()->getPostProcessor()
        ))
            ->from(ConfigService::$tableContent);
    }

    public function createSearchIndexes()
    {
        //delete old indexes
        $this->deleteOldIndexes();

        $query = $this->contentQuery()
            ->selectPrimaryColumns()
            ->restrictByTypes(ConfigService::$searchableContentTypes)
            ->orderBy('id');

        $query->chunk(
            100,
            function ($query) {
                $contentFieldRows = $this->fieldRepository->getByContentIds($query->pluck('id')->toArray());
                $contentDatumRows = $this->datumRepository->getByContentIds($query->pluck('id')->toArray());

                $fieldRowsGrouped = ContentHelper::groupArrayBy($contentFieldRows, 'content_id');
                $datumRowsGrouped = ContentHelper::groupArrayBy($contentDatumRows, 'content_id');

                // insert new indexes in the DB
                foreach ($query as $content) {
                    $content['fields'] = $fieldRowsGrouped[$content['id']] ?? [];
                    $content['data'] = $datumRowsGrouped[$content['id']] ?? [];

                    $searchInsertData = [
                        'high_value' => $this->prepareIndexesValues('high_value', $content),
                        'medium_value' => $this->prepareIndexesValues('medium_value', $content),
                        'low_value' => $this->prepareIndexesValues('low_value', $content),
                        'brand' => $content['brand'],
                        'content_type' => $content['type'],
                        'content_status' => $content['status'],
                        'content_published_on' => $content['published_on'] ?? Carbon::now(),
                        'created_at' => Carbon::now()->toDateTimeString()
                    ];

                    $this->updateOrCreate(
                        ['content_id' => $content['id'],],
                        $searchInsertData,
                        'content_id'
                    );
                }
            }
        );

        DB::statement('OPTIMIZE table '.ConfigService::$tableSearchIndexes);
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
     * @param string $type
     * @param array $content
     * @return string
     */
    private function prepareIndexesValues($type, $content)
    {
        $searchIndexValues = ConfigService::$searchIndexValues;
        $configSearchIndexValues = $searchIndexValues[$type];
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

    /**
     * Perform a boolean full text search by term, paginate and order the results by score.
     * Returns an array with the contents that contain the search criteria
     *
     * @param string|null $term
     * @param int $page
     * @param int $limit
     * @param array $contentTypes
     * @param array $contentStatuses
     * @param $orderByColumn
     * @param $orderByDirection
     * @param null $dateTimeCutoff
     * @return array
     * @internal param null $contentType
     */
    public function search(
        $term,
        $page = 1,
        $limit = 10,
        $contentTypes = [],
        $contentStatuses = [],
        $orderByColumn = 'score',
        $orderByDirection = 'desc',
        $dateTimeCutoff = null
    ) {
        $query = $this->query()
            ->selectColumns($term)
            ->restrictBrand()
            ->restrictByTerm($term)
            ->order($orderByColumn, $orderByDirection)
            ->directPaginate($page, $limit);

        if (!empty($contentTypes)) {
            $query->whereIn('content_type', $contentTypes);
        }

        if (!empty($contentStatuses)) {
            $query->whereIn('content_status', $contentStatuses);
        }

        if (!empty($dateCutoff)) {
            $query->where('content_published_on', '>', $dateTimeCutoff);
        }

        $contentRows = $query->getToArray();

        return array_column($contentRows, 'content_id');

    }

    /** Count all the matches
     *
     * @param string|null $term
     * @param null $contentType
     * @return int
     */
    public function countTotalResults(
        $term,
        $contentType = null,
        $contentStatus = null,
        $dateTimeCutoff = null
    ) {
        $query = $this->query()
            ->selectColumns($term)
            ->restrictByTerm($term)
            ->restrictBrand();

        if (!empty($contentType)) {
            $query->where('content_type', $contentType);
        }

        if (!empty($contentStatus)) {
            $query->where('content_status', $contentStatus);
        }

        if (!empty($dateCutoff)) {
            $query->where('content_published_on', '>', $dateTimeCutoff);
        }

        return $query->count();
    }
}