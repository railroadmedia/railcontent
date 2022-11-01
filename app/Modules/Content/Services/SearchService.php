<?php

namespace App\Modules\Content\Services;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\SearchIndex;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;

class SearchService
{
    private ContentRepository $contentRepository;
    private ContentFieldRepository $fieldRepository;
    private ContentDatumRepository $datumRepository;

    public function __construct(
        ContentRepository $contentRepository,
        ContentFieldRepository $fieldRepository,
        ContentDatumRepository $datumRepository
    ) {
        $this->contentRepository = $contentRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
    }

    public function rebuildIndexes()
    {
        Log::debug('Rebuilding Search Indexes');
        DB::statement('DROP TABLE IF EXISTS railcontent_search_indexes_staging');
        DB::statement('CREATE TABLE railcontent_search_indexes_staging LIKE railcontent_search_indexes');

        $types = $this->getContentTypes();
        $statuses = ConfigService::$indexableContentStatuses;
        $query = Content::query()->whereNotFuture()->whereStatuses($statuses)->whereTypes($types)->orderBy('id');

        $query->chunk(1000, function ($query) {
            $contentRows = $query->toArray();

            $fieldRowsGrouped = $this->contentRepository->getFieldsByContentIds($contentRows);
            $contentDatumRows = $this->datumRepository->getByContentIds(
                $query->pluck('id')
                    ->toArray()
            );
            $datumRowsGrouped = ContentHelper::groupArrayBy($contentDatumRows, 'content_id');

            $toInsert = [];
            foreach ($contentRows as $content) {
                $content['fields'] = $fieldRowsGrouped[$content['id']] ?? [];
                $content['data'] = $datumRowsGrouped[$content['id']] ?? [];

                $instructors = ContentHelper::getFieldValues($content, 'instructor');
                $instructorNames = [];
                if (!empty($instructors)) {
                    $instructorNames = (Arr::pluck($instructors, 'id'));
                }

                $searchIndex = new SearchIndex();
                $searchIndex->content_id = $content['id'];
                $searchIndex->high_value = $this->prepareIndexesValues('high_value', $content);
                $searchIndex->medium_value = $this->prepareIndexesValues('medium_value', $content);
                $searchIndex->low_value = $this->prepareIndexesValues('low_value', $content);
                $searchIndex->brand = $content['brand'];
                $searchIndex->content_type = $content['type'];
                $searchIndex->content_status = $content['status'];
                $searchIndex->content_instructors = implode(',', $instructorNames);
                $searchIndex->content_published_on = $content['published_on'] ?? Carbon::today()->toDateTimeString();
                $searchIndex->created_at = Carbon::today()->toDateTimeString();
                $toInsert[] = $searchIndex->toArray();
            }
            DB::table('railcontent_search_indexes_staging')->insert($toInsert);
        });

        DB::statement('OPTIMIZE table railcontent_search_indexes_staging');
        DB::statement(
            'RENAME TABLE railcontent_search_indexes TO railcontent_search_indexes_old,
                                railcontent_search_indexes_staging to railcontent_search_indexes'
        );
        DB::statement('DROP TABLE railcontent_search_indexes_old');
        Log::debug('Finished Rebuilding Search Indexes');
        usleep(250000); //delay 250 ms to reduce load
    }

    /**
     * @return array
     */
    public function getContentTypes(): array
    {
        $brands = config('railcontent.available_brands');
        $showTypes = [];
        foreach ($brands as $brand) {
            $showTypes += config('railcontent.showTypes', [])[$brand] ?? [];
        }

        $types = array_unique(
            array_merge(
                $showTypes,
                config('railcontent.topLevelContentTypes', []),
                config('railcontent.searchable_content_types', []),
                config('railcontent.singularContentTypes', [])
            )
        );
        return $types;
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

        if (in_array(' * ', $configSearchIndexValues['data_keys'])) {
            foreach ($content['data'] as $data) {
                $values[] = $data['value'];
            }
        } else {
            foreach ($configSearchIndexValues['data_keys'] as $dataKey) {
                $values = array_merge($values, ContentHelper::getDatumValues($content, $dataKey));
            }
        }

        foreach ($values as $valueIndex => $value) {
            $values[$valueIndex] = str_replace(' / ', '_', $value);
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
            $query->whereIn(ConfigService::$tableSearchIndexes . ' . content_type', $contentTypes);
        }

        if (!empty($contentStatuses)) {
            $query->whereIn('content_status', $contentStatuses);
        }

        if (!empty($dateCutoff)) {
            $query->where('content_published_on', ' > ', $dateTimeCutoff);
        }

        if (!empty($coachIds)) {
            $query->where(function (Builder $builder) use ($coachIds) {
                foreach ($coachIds as $coachId) {
                    return $builder->orwhereRaw(' FIND_IN_SET(' . $coachId . ', content_instructors)');
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
            $query->whereIn(ConfigService::$tableSearchIndexes . ' . content_type', $contentType);
        }

        if (!empty($contentStatus)) {
            $query->where('content_status', $contentStatus);
        }

        if (!empty($dateCutoff)) {
            $query->where('content_published_on', ' > ', $dateTimeCutoff);
        }

        if (!empty($coachIds)) {
            $query->where(function (Builder $builder) use ($coachIds) {
                foreach ($coachIds as $coachId) {
                    return $builder->orwhereRaw(' FIND_IN_SET(' . $coachId . ', content_instructors)');
                }
            });
        }

        return $query->count();
    }
}
