<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Requests\ContentIndexRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\SearchInterface;

class FieldRepository extends RepositoryBase implements SearchInterface
{
    public $search;

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

        if(!$update){
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
                    ConfigService::$tableFields.' as field'.$requiredKeys,
                    function($join) use ($requiredKeys, $requiredValues) {
                        $join
                            ->where('field'.$requiredKeys.'.key', $requiredKeys)
                            ->where(function($builder) use ($requiredKeys, $requiredValues) {
                                return $builder->where('field'.$requiredKeys.'.value', $requiredValues)
                                    ->orWhere('field'.$requiredKeys.'.type', 'content_id');
                            }
                            );
                    }
                );

                //linked content fields
                $queryBuilder->leftJoin(
                    ConfigService::$tableContentFields.' as contentfield'.$requiredKeys,
                    function($join) use ($requiredKeys) {
                        $join->on('contentfield'.$requiredKeys.'.content_id', '=', ConfigService::$tableContent.'.id')
                            ->on('contentfield'.$requiredKeys.'.field_id', 'field'.$requiredKeys.'.id');
                    }
                );

                //linked parent fields
                $queryBuilder->leftJoin(
                    ConfigService::$tableContentFields.' as parentfield'.$requiredKeys,
                    function($join) use ($requiredKeys) {
                        $join->on('parentfield'.$requiredKeys.'.content_id', '=', ConfigService::$tableContent.'.parent_id')
                            ->on('parentfield'.$requiredKeys.'.field_id', '=', 'field'.$requiredKeys.'.id');
                    }
                );

                //join with content for fields with content_id type
                $queryBuilder->leftJoin(
                    ConfigService::$tableContent.' as fieldcontent'.$requiredKeys,
                    function($join) use ($requiredKeys, $requiredValues) {
                        $join->on('fieldcontent'.$requiredKeys.'.id', '=', 'field'.$requiredKeys.'.value')
                            ->where(function($builder) use ($requiredKeys) {
                                return $builder->whereNotNull('contentfield'.$requiredKeys.'.id')->orWhereNotNull('parentfield'.$requiredKeys.'.id');
                            })
                            ->where('fieldcontent'.$requiredKeys.'.slug', $requiredValues);
                    });

                $queryBuilder->where(function($builder) use ($requiredKeys) {
                    return $builder->whereNotNull('fieldcontent'.$requiredKeys.'.id')
                        ->orWhere(function($builder) use ($requiredKeys) {
                            return $builder->where('field'.$requiredKeys.'.type', '<>', 'content_id')
                                ->where(function($builder) use ($requiredKeys) {
                                    return $builder->whereNotNull('contentfield'.$requiredKeys.'.id')
                                        ->orWhereNotNull('parentfield'.$requiredKeys.'.id');
                                });
                        });
                });
            }

        return $queryBuilder;
    }
}