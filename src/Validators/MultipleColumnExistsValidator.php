<?php

namespace Railroad\Railcontent\Validators;

use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Repositories\QueryBuilders\QueryBuilder;

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

        /* -------------------------------------------------------------------------------------------------------------
         * Prepare data
         * ---------------------------------------------------------------------------------------------------------- */

        foreach ($setsOfParamsForClauses as &$paramsForClause) {

            /* -------------------------------------------------------------------------------
             * If there's any "OR" clauses, separate them now.
             * ---------------------------------------------------------------------------- */

            $paramsForClause = explode(',', $paramsForClause);

            if (!isset($paramsForClause[3]) && (count($paramsForClause) === 3)) {
                $paramsForClause[] = $value;
            }

            if (substr($paramsForClause[0], 0, strlen('or:')) == 'or:') {
                $paramsForClause[0] = substr($paramsForClause[0], strlen('or:'));
                $paramsForClause[] = 'or';
            }
        }

        /* -------------------------------------------------------------------------------------------------------------
         * Prepare sets that will be used to create QueryBuilders objects
         * ---------------------------------------------------------------------------------------------------------- */

        foreach ($setsOfParamsForClauses as $key => &$paramsForClause) {

            $connection = $paramsForClause[0];
            $table = $paramsForClause[1];
            $row = $paramsForClause[2];
            $value = $paramsForClause[3];
            $or = isset($paramsForClause[4]) && ($paramsForClause[4] === 'or' );

            /** @var \Illuminate\Database\Query\Builder $query */
            $query = &$queries[$connection][$table];

            if($or){

                if($key > 0){
                    /*
                     * If there is a previous $paramsForClause item in the array we're currently looping through,
                     * that means the one before this one should be part of the "whereOr" condition. Thus, remove it
                     * from the "where" set, and place together with the current "orWhere"-applicable item.
                     */
                    $toKeep = $query['where'][(string) ($key - 1)];

                    if(isset($query['where'][(string) ($key - 1)])){
                        unset($query['where'][(string) ($key - 1)]);
                    }

                    /*
                     * Yes, we want this in the same item because the orWhere is for the current and previous together.
                     */
                    $query['orWhere'][(string) $key][] = $toKeep;
                }

                $query['orWhere'][(string) $key][] = [$row, '=', $value];
                continue;
            }

            $query['where'][(string) $key] = [$row, '=', $value];
        }

        /* -------------------------------------------------------------------------------------------------------------
         * Group clauses by connection-table
         * ---------------------------------------------------------------------------------------------------------- */

        $queriesToRun = [];

        foreach($queries as $connectionName => $connections){
            foreach($connections as $tableName => $tables){

                // why does this set $connections[$tableName] to a query?
                $query = $this->databaseManager->connection($connectionName)->table($tableName);

                if(isset($tables['where'])){
                    foreach($tables['where'] as $where){
                        $query = $query->where([$where]);
                    }
                }

                if(isset($tables['orWhere'])){
                    foreach($tables['orWhere'] as $orWhere){
                        $query->where(function($query) use ($orWhere){ /**  @var $query QueryBuilder */
                            foreach($orWhere as $index => $orWhereItem){
                                if($index === 0){
                                    $query->where([$orWhereItem]);
                                }else{
                                    $query->orWhere([$orWhereItem]);
                                }
                            }
                        });
                    }
                }
                $queriesToRun[] = $query;
            }
        }

        /* -------------------------------------------------------------------------------------------------------------
         * Run queries to validate input
         * ---------------------------------------------------------------------------------------------------------- */

        foreach ($queriesToRun as $query) {

            if(!$query->exists()){
                return false;
            }

        }

        return true;
    }
}