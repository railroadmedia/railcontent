<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Requests\ContentIndexRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\SearchInterface;

class FieldRepository extends LanguageRepository implements SearchInterface
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
        //delete field value from translation table
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
     * @return array
     */
    public function getFieldByKeyAndValue($key, $value)
    {
        $builder = $this->query();
        $builder = $this->addTranslations($builder);

        return $builder
            ->select(ConfigService::$tableFields.'.*', 'translation_'.ConfigService::$tableFields.'.value as translate_value')
            ->where(['key' => $key, 'translate_value' => $value])->get()->first();
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableFields);
    }

    /** Generate the query builder
     * @return Builder
     */
    public function generateQuery()
    {
        $queryBuilder = $this->search->generateQuery();

        //get fields from requests or empty array
        $fields = request()->fields ?? [];

        foreach($fields as $requiredKeys => $requiredValues) {
            //get the field with translated value
            $queryBuilder->leftJoin(
                ConfigService::$tableTranslations.' as searched_field'.$requiredKeys,
                function($join) use ($requiredKeys, $requiredValues) {
                    $join->where('searched_field'.$requiredKeys.'.language_id', $this->getUserLanguage())
                        ->where('searched_field'.$requiredKeys.'.value', $requiredValues);
                }
            );

            //get the field from tableFields
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

            //get the link between content or content parent and the field
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