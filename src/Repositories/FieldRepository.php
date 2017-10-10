<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Requests\ContentIndexRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\SearchInterface;

class FieldRepository extends RepositoryBase implements SearchInterface
{
    protected $search;

    /**
     * FieldRepository constructor.
     * @param $search
     */
    public function __construct(SearchInterface $search)
    {
        $this->search = $search;
    }

    /**
     * Update or insert a new record in the railcontent_fields table
     * @param integer $id
     * @param string $key
     * @param string $value
     * @return int
     */
    public function updateOrCreateField($id, $key, $value, $type, $position)
    {
        $update = $this->query()->where('id', $id)->update(
            [
                'key' => $key,
                'value' => $value,
                'type' => $type,
                'position' => $position
            ]
        );

        if(!$update) {
            $id = $this->query()->insertGetId(
                [
                    'key' => $key,
                    'value' => $value,
                    'type' => $type,
                    'position' => $position
                ]
            );
        }

        return $id;
    }

    /**
     * Delete a record from railcontent_fields table
     * @param integer $id
     */
    public function deleteField($id)
    {
        $this->deleteTranslations(
            [
                'entity_type' => ConfigService::$tableFields,
                'entity_id' => $id
            ]
        );

        return $this->query()->where([
                'id' => $id
            ]
        )->delete();
    }

    /** Get field from database based on key and value pair
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function getFieldByKeyAndValue($key, $value)
    {
        return $this->query()->where(['key' => $key, 'value' => $value])->get()->first();
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableFields);
    }

    /**
     * @param ContentIndexRequest $request
     * @return mixed
     */
    public function generateQuery()
    {
        $queryBuilder = $this->search->generateQuery();

        //get fields from requests or empty array
        $fields = request()->fields ?? [];

        foreach($fields as $requiredKeys => $requiredValues) {
            $queryBuilder->leftJoin(
                ConfigService::$tableTranslations.' as searched_field'.$requiredKeys,
                function($join) use ($requiredKeys, $requiredValues) {
                    $join->where('searched_field'.$requiredKeys.'.language_id', $this->getUserLanguage())
                        ->where('searched_field'.$requiredKeys.'.value', $requiredValues);
                }
            );

            $queryBuilder->leftJoin(
                ConfigService::$tableFields.' as field'.$requiredKeys,
                function($join) use ($requiredKeys, $requiredValues) {
                    $join->on('field'.$requiredKeys.'.id', 'searched_field'.$requiredKeys.'.entity_id')
                        ->orWhere(function($join) use ($requiredKeys) {
                            $join->where('field'.$requiredKeys.'.type', 'content_id')
                                ->on('field'.$requiredKeys.'.value', 'searched_field'.$requiredKeys.'.entity_id');
                        });
                }
            );

            $queryBuilder->leftJoin(ConfigService::$tableContentFields.' as incontentfield'.$requiredKeys, function($join) use ($requiredKeys) {
                return $join->on('incontentfield'.$requiredKeys.'.field_id', 'field'.$requiredKeys.'.id')
                    ->on('incontentfield'.$requiredKeys.'.content_id', ConfigService::$tableContent.'.parent_id')
                    ->orOn('incontentfield'.$requiredKeys.'.content_id', ConfigService::$tableContent.'.id');
            });

            $queryBuilder->addSelect('incontentfield'.$requiredKeys.'.content_id as incontent'.$requiredKeys.'_content_id');

            $queryBuilder->where(function($builder) use ($requiredKeys, $requiredValues) {
                $builder->whereNotNull('incontentfield'.$requiredKeys.'.id');
            }
            );
        }
        return $queryBuilder;
    }
}