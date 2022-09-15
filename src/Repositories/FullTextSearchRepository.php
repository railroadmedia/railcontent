<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Repositories\QueryBuilders\FullTextSearchQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;

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
    public function query()
    {
        return (new FullTextSearchQueryBuilder(
            $this->connection(),
            $this->connection()
                ->getQueryGrammar(),
            $this->connection()
                ->getPostProcessor()
        ))->from(ConfigService::$tableSearchIndexes);
    }

    /**
     * @return ContentQueryBuilder
     */
    protected function contentQuery()
    {
        return (new ContentQueryBuilder(
            $this->connection(),
            $this->connection()
                ->getQueryGrammar(),
            $this->connection()
                ->getPostProcessor()
        ))->from(ConfigService::$tableContent);
    }

    public function createSearchIndexes()
    {
        //delete old indexes
        $this->deleteOldIndexes();
        $brands = config('railcontent.available_brands');
        $showTypes = [];
        foreach ($brands as $brand){
            $showTypes += config('railcontent.showTypes', [])[$brand] ?? [];
        }

        $query =
            $this->contentQuery()
                ->selectPrimaryColumns()
                ->restrictByTypes(
                    array_unique(
                        array_merge(
                            $showTypes,
                            config('railcontent.topLevelContentTypes', []),
                            config('railcontent.searchable_content_types', []),
                            config('railcontent.singularContentTypes', [])
                        )
                    )
                )
                ->orderBy('id');

        $query->chunk(100, function ($query) {
            $contentRows = $query->toArray();

            $fieldRowsGrouped = $this->contentRepository->getFieldsByContentIds($contentRows);
            $contentDatumRows = $this->datumRepository->getByContentIds(
                $query->pluck('id')
                    ->toArray()
            );
            $datumRowsGrouped = ContentHelper::groupArrayBy($contentDatumRows, 'content_id');

            // insert new indexes in the DB
            foreach ($contentRows as $content) {
                $content['fields'] = $fieldRowsGrouped[$content['id']] ?? [];
                $content['data'] = $datumRowsGrouped[$content['id']] ?? [];

                $instructors = ContentHelper::getFieldValues($content, 'instructor');
                $instructorNames = [];
                if (!empty($instructors)) {
                    $instructorNames = (Arr::pluck($instructors, 'id'));
                }

                $searchInsertData = [
                    'high_value' => $this->prepareIndexesValues('high_value', $content),
                    'medium_value' => $this->prepareIndexesValues('medium_value', $content),
                    'low_value' => $this->prepareIndexesValues('low_value', $content),
                    'brand' => $content['brand'],
                    'content_type' => $content['type'],
                    'content_status' => $content['status'],
                    'content_instructors' => implode(',', $instructorNames),
                    'content_published_on' => $content['published_on'] ?? Carbon::now(),
                    'created_at' => Carbon::now()
                        ->toDateTimeString(),
                ];

                $this->updateOrCreate(
                    ['content_id' => $content['id'],],
                    $searchInsertData,
                    'content_id'
                );
            }
        });

        $this->connection()
            ->statement('OPTIMIZE table '.ConfigService::$tableSearchIndexes);
    }

    /** Delete old indexes for the brand
     *
     * @return mixed
     */
    private function deleteOldIndexes()
    {
        return $this->query()
            ->delete();
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

        foreach ($values as $valueIndex => $value) {
            $values[$valueIndex] = str_replace('/', '_', $value);
        }

        return substr(preg_replace("/[^A-Za-z0-9 ]/", '', implode(' ', array_unique($values))), 0, 245);
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
        $dateTimeCutoff = null,
        $coachIds = []
    ) {
        $query =
            $this->query()
                ->selectColumns($term)
                ->restrictByPermissions()
                ->restrictBrand()
                ->restrictByTerm($term)
                ->order($orderByColumn, $orderByDirection)
                ->directPaginate($page, $limit);

        if (!empty($contentTypes)) {
            $query->whereIn(ConfigService::$tableSearchIndexes.'.content_type', $contentTypes);
        }

        if (!empty($contentStatuses)) {
            $query->whereIn('content_status', $contentStatuses);
        }

        if (!empty($dateCutoff)) {
            $query->where('content_published_on', '>', $dateTimeCutoff);
        }

        if (!empty($coachIds)) {
            $query->where(function (Builder $builder) use ($coachIds) {
                foreach ($coachIds as $coachId) {
                    return $builder->orwhereRaw(' FIND_IN_SET('.$coachId.',content_instructors)');
                }
            });
        }

        $contentRows = $query->getToArray();

        return array_column($contentRows, 'content_id');
    }

    /** Count all the matches
     *
     * @param string|null $term
     * @param array $contentType
     * @return int
     */
    public function countTotalResults(
        $term,
        $contentType = [],
        $contentStatus = null,
        $dateTimeCutoff = null,
        $coachIds = []
    ) {
        $query =
            $this->query()
                ->selectColumns($term)
                ->restrictByPermissions()
                ->restrictByTerm($term)
                ->restrictBrand();

        if (!empty($contentType)) {
            $query->whereIn(ConfigService::$tableSearchIndexes.'.content_type', $contentType);
        }

        if (!empty($contentStatus)) {
            $query->where('content_status', $contentStatus);
        }

        if (!empty($dateCutoff)) {
            $query->where('content_published_on', '>', $dateTimeCutoff);
        }

        if (!empty($coachIds)) {
            $query->where(function (Builder $builder) use ($coachIds) {
                foreach ($coachIds as $coachId) {
                    return $builder->orwhereRaw(' FIND_IN_SET('.$coachId.',content_instructors)');
                }
            });
        }

        return $query->count();
    }
}
