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
        $queries = [];

        $parameters = implode(',', $parameters);
        $setsOfParamsForClauses = explode('&', $parameters);

        foreach ($setsOfParamsForClauses as $paramsForClause) {

            $parameterParts = explode(',', $paramsForClause);

            $connection = $parameterParts[0];
            $table = $parameterParts[1];

            if(!isset($queries[$connection])){
                $queries[$connection] = [];
            }

            if(empty($queries[$connection][$table])){
                $queries[$connection][$table] = $this->databaseManager->connection($connection)->table($table);
            }
        }

        foreach ($setsOfParamsForClauses as $key => &$paramsForClause) {

            $parameterParts = explode(',', $paramsForClause);

            $connection = $parameterParts[0];
            $table = $parameterParts[1];
            $row = $parameterParts[2];
            $value = isset($parameterParts[3]) ? $parameterParts[3] : $value;

            /** @var \Illuminate\Database\Query\Builder $query */
            $query = &$queries[$connection][$table];

            if(isset($parameterParts[3])){
                if(strpos($parameterParts[3], 'or:') !== false){
                    $query = $query->orWhere($row, $value);
                    continue;
                }
            }

            $query = $query->where($row, $value);
        }

        foreach ($queries as $queriesForConnection) {
            foreach ($queriesForConnection as $queryForTable) {
                if(!$queryForTable->exists()){
                    return '0';
                }
            }
        }

        return true;
    }
}