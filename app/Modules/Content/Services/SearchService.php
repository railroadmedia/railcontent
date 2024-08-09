<?php

namespace App\Modules\Content\Services;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\SearchIndex;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;

class SearchService
{
    private ContentRepository $contentRepository;
    private ContentDatumRepository $datumRepository;

    public function __construct(
        ContentRepository $contentRepository,
        ContentDatumRepository $datumRepository
    ) {
        $this->contentRepository = $contentRepository;
        $this->datumRepository = $datumRepository;
    }

    public function rebuildIndexes(): void
    {
        Log::debug('Rebuilding Search Indexes');
        DB::statement('DROP TABLE IF EXISTS railcontent_search_indexes_staging');
        if (app()->environment('testing')) {
            DB::statement(
                'CREATE TABLE railcontent_search_indexes_staging AS SELECT * FROM railcontent_search_indexes WHERE 0'
            );
        } else {
            DB::statement('CREATE TABLE railcontent_search_indexes_staging LIKE railcontent_search_indexes');
        }

        $types = $this->getContentTypes();
        $statuses = ConfigService::$indexableContentStatuses;
        $query = Content::query()->select(array_merge(['id', 'slug', 'title', 'brand', 'status', 'type', 'published_on'], config('railcontent.contentColumnNamesForFields')))
            ->whereStatuses($statuses)->whereTypes($types)->orderBy('id');

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
                $searchIndex->content_instructors = substr(implode(',', $instructorNames), 0, 64);
                $searchIndex->content_published_on = $content['published_on'] ?? Carbon::now()->toDateTimeString();
                $searchIndex->created_at = Carbon::now()->toDateTimeString();
                $toInsert[] = $searchIndex->toArray();
            }
            DB::table('railcontent_search_indexes_staging')->insert($toInsert);
            usleep(250000); //delay 250 ms to reduce load
        });

        if (app()->environment('testing')) {
            DB::statement('ALTER TABLE railcontent_search_indexes RENAME TO railcontent_search_indexes_old');
            DB::statement('ALTER TABLE railcontent_search_indexes_staging RENAME TO railcontent_search_indexes');
        } else {
            DB::statement('OPTIMIZE table railcontent_search_indexes_staging');
            DB::statement(
                'RENAME TABLE railcontent_search_indexes TO railcontent_search_indexes_old,
                                railcontent_search_indexes_staging to railcontent_search_indexes'
            );
        }
        DB::statement('DROP TABLE railcontent_search_indexes_old');
        Log::debug('Finished Rebuilding Search Indexes');
    }

    private function getContentTypes(): array
    {
        $brands = config('railcontent.available_brands');
        $showTypes = [];
        foreach ($brands as $brand) {
            $showTypes += config('railcontent.showTypes', [])[$brand] ?? [];
        }

        return array_unique(
            array_merge(
                $showTypes,
                config('railcontent.topLevelContentTypes', []),
                config('railcontent.searchable_content_types', []),
                config('railcontent.singularContentTypes', [])
            )
        );
    }

    /** Prepare search indexes based on config settings
     *
     * @param string $type
     * @param array $content
     * @return string
     */
    private function prepareIndexesValues(string $type, array $content): string
    {
        $searchIndexValues = ConfigService::$searchIndexValues;
        $configSearchIndexValues = $searchIndexValues[$type];
        $values = [];

        foreach ($configSearchIndexValues['content_attributes'] as $contentAttribute) {
            $values[] = $content["$contentAttribute"];
        }

        if (in_array('*', $configSearchIndexValues['field_keys'])) {
            foreach ($content['fields'] as $field) {
                $value = is_array($field['value']) ? '' : trim(str_replace('/', '_', $field['value']));
                if ($value && !in_array($value, $values)) {
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

        return substr(preg_replace("/[^A-Za-z0-9_ ]/", '', implode(' ', array_unique($values))), 0, 245);
    }

}
