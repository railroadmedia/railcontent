<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/15/2017
 * Time: 4:24 PM
 */

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\LanguageRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railcontent\Requests\ContentIndexRequest;

class SearchService extends LanguageRepository implements SearchInterface
{
    protected $search;

    /**
     * Search constructor.
     * @param $searchService
     */
    public function __construct(SearchInterface $searchService)
    {
        $this->search = $searchService;

    }

    /**
     * @return mixed
     */
    public function generateQuery()
    {
        $queryBuilder = $this->search->generateQuery();

        return $queryBuilder;
    }

    /**Search the content based on request input value
     * @return array
     */
    private function search()
    {
        $query = $this->generateQuery();
        $query = $this->addTranslations($query);

        $statues = request()->statues ?? [];
        $types = request()->types ?? [];
        $parentSlug = request()->parent_id ?? null;

        $query
            ->whereIn(ConfigService::$tableContent.'.status', $statues)
            ->whereIn(ConfigService::$tableContent.'.type', $types)
            ->where(ConfigService::$tableContent.'.brand', ConfigService::$brand);

        $parentId = null;

        if(!is_null($parentSlug)) {
            $parent = $this->getBySlug($parentSlug);
            $parentId = key($parent);
        }

        if(!is_null($parentId)) {
            $query->where(ConfigService::$tableContent.'.parent_id', $parentId);
        }

        if(!request()->include_feature) {
            $query->where(
                function(Builder $builder) {
                    return $builder->where(
                        ConfigService::$tableContent.'.published_on',
                        '<',
                        Carbon::now()->toDateTimeString()
                    )
                        ->orWhereNull(ConfigService::$tableContent.'.published_on');
                }
            );
        }

        $page = request()->page;
        $page--;
        $orderByColumn = request()->order_by ?? 'id';
        $orderByDirection = request()->order ?? 'desc';
        $amount = request()->amount ?? 10;

        $query->orderBy($orderByColumn, $orderByDirection)
            ->skip($page * $amount)
            ->limit($amount);

        return $query->get();
    }

    /*
     * Return contents in correct format
     */
    public function getPaginated()
    {
        $fieldsWithContent = $this->search();

        return $this->parseAndGetLinkedContent($fieldsWithContent);
    }

    /**
     * @param $fieldsWithContent
     * @return array
     */
    private function parseAndGetLinkedContent($fieldsWithContent)
    {
        $linkedContentIdsToGrab = [];

        foreach($fieldsWithContent as $fieldWithContent) {
            if($fieldWithContent['field_type'] === 'content_id') {
                $linkedContentIdsToGrab[] = $fieldWithContent['field_value'];
            }
        }

        $linkedContents = [];

        if(!empty($linkedContentIdsToGrab)) {
            $linkedContents = $this->getManyById($linkedContentIdsToGrab);
        }

        $content = [];

        foreach($fieldsWithContent as $fieldWithContent) {
            $content[$fieldWithContent['id']] = [
                'id' => $fieldWithContent['id'],
                'slug' => $fieldWithContent['translation_railcontent_content_value'],
                'status' => $fieldWithContent['status'],
                'type' => $fieldWithContent['type'],
                'position' => $fieldWithContent['position'],
                'parent_id' => $fieldWithContent['parent_id'],
                'published_on' => $fieldWithContent['published_on'],
                'created_on' => $fieldWithContent['created_on'],
                'archived_on' => $fieldWithContent['archived_on'],
                'brand' => $fieldWithContent['brand']
            ];
        }

        foreach($fieldsWithContent as $fieldWithContent) {
            if(($fieldWithContent['field_id'] === null) && ($fieldWithContent['datum_id'] === null)) {
                continue;
            }

            if($fieldWithContent['field_type'] === 'content_id') {

                $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']] = [
                    'id' => $linkedContents[$fieldWithContent['field_value']]['id'],
                    'slug' => $linkedContents[$fieldWithContent['field_value']]['slug'],
                    'status' => $linkedContents[$fieldWithContent['field_value']]['status'],
                    'type' => $linkedContents[$fieldWithContent['field_value']]['type'],
                    'position' => $linkedContents[$fieldWithContent['field_value']]['position'],
                    'parent_id' => $linkedContents[$fieldWithContent['field_value']]['parent_id'],
                    'published_on' => $linkedContents[$fieldWithContent['field_value']]['published_on'],
                    'created_on' => $linkedContents[$fieldWithContent['field_value']]['created_on'],
                    'archived_on' => $linkedContents[$fieldWithContent['field_value']]['archived_on'],
                    'brand' => $linkedContents[$fieldWithContent['field_value']]['brand']
                ];

                if(array_key_exists('fields', $linkedContents[$fieldWithContent['field_value']])) {
                    foreach($linkedContents[$fieldWithContent['field_value']]['fields'] as
                            $linkedContentFieldKey => $linkedContentFieldValue) {

                        $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']]
                        ['fields'][$linkedContentFieldKey] = $linkedContentFieldValue;
                    }
                }

                if(array_key_exists('datum', $linkedContents[$fieldWithContent['field_value']])) {
                    foreach($linkedContents[$fieldWithContent['field_value']]['datum'] as
                            $linkedContentDatumKey => $linkedContentDatumValue) {

                        $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']]
                        ['datum'][$linkedContentDatumKey] = $linkedContentDatumValue;
                    }
                }

            } else {
                // put multiple fields with same key in to an array
                if($fieldWithContent['field_type'] == 'multiple') {

                    $content[$fieldWithContent['id']]
                    ['fields']
                    [$fieldWithContent['field_key']]
                    [$fieldWithContent['field_position']] =
                        $fieldWithContent['translation_railcontent_fields_value'];

                } elseif($fieldWithContent['field_id']) {

                    $content[$fieldWithContent['id']]
                    ['fields']
                    [$fieldWithContent['field_key']] =
                        $fieldWithContent['translation_railcontent_fields_value'];
                }
            }

            //put datum as array key => value
            if($fieldWithContent['datum_id']) {
                $content[$fieldWithContent['id']]
                ['datum']
                [$fieldWithContent['datum_key']] =
                    $fieldWithContent['translation_railcontent_data_value'];
            }
        }

        return $content;
    }

    /*
     * Get content based on id or null
     */
    public function getById($id)
    {
        return $this->getManyById([$id])[$id] ?? null;
    }

    /**
     * @param $ids
     * @return array
     */
    public function getManyById($ids)
    {
        $search = new SearchService(new PermissionRepository(new ContentRepository()));

        $builder = $search->generateQuery();
        $builder = $this->addTranslations($builder);
        $builder->whereIn(ConfigService::$tableContent.'.id', $ids);

        $builder = $builder->get();

        return $this->parseAndGetLinkedContent($builder);
    }

    /**
     *
     * If the parent id is null it will pull all rows with that slug under ANY parent including null
     *
     * @param $slug
     * @param $parentId
     * @return array
     */
    public function getBySlug($slug, $parentId = null)
    {
        $search = new SearchService(new PermissionRepository(new ContentRepository()));

        $builder = $search->generateQuery();
        $builder = $this->addTranslations($builder);

        $builder->where('translation_'.ConfigService::$tableContent.'.value', $slug);

        if(!is_null($parentId)) {
            $builder = $builder->where('parent_id', $parentId);
        }

        $builder = $builder->get();

        return $this->parseAndGetLinkedContent($builder);
    }
}

