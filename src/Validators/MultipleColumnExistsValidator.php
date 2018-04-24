<?php

namespace Railroad\Railcontent\Validators;

use Illuminate\Database\DatabaseManager;

class MultipleColumnExistsValidator
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * MultipleColumnExistsValidator constructor.
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator)
    {
        $parameters = implode(',', $parameters);
        $parameters = explode('&', $parameters);

        $queryParams = [];
        $queries = [];

        foreach ($parameters as $parameter) {

            $parameterParts = explode(',', $parameter);

            $connection = $parameterParts[0];
            $table = $parameterParts[1];

            if(!isset($queryParams[$connection])){
                $queryParams[$connection] = [];
            }

            if(!isset($queryParams[$connection][$table])){
                $queryParams[$connection][$table] = [];
            }

            $queryParams[$connection][$table][] = $this->databaseManager->connection($connection)->table($table);
        }

        foreach ($parameters as $key => &$parameter) {

            $parameterParts = explode(',', $parameter);

            $connection = $parameterParts[0];
            $table = $parameterParts[1];
            $row = $parameterParts[2];
            $value = isset($parameterParts[3]) ? $parameterParts[3] : $value;

            $or = false;
            if(isset($parameterParts[3])){
                if(strpos($parameterParts[3], 'or:') !== false){
                    $or = true;
                }
            }

            /** @var \Illuminate\Database\Query\Builder $query */
            foreach($queryParams[$connection][$table] as &$query){
                if($or){
                    $queries[] = $query->orWhere($row, $value);
                }else{
                    $queries[] = $query->where($row, $value);
                }
            }
        }

        foreach ($queries as $query) {
            if(!$query->exists()){
                return '0';
            }
        }

        return true;
    }
}