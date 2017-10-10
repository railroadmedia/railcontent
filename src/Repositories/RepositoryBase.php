<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\ConfigService;
use Illuminate\Http\Request;

class RepositoryBase
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * CategoryRepository constructor.
     */
    public function __construct()
    {
        $this->databaseManager = app('db');
    }

    /**
     * @return Connection
     */
    protected function connection()
    {
        return app('db')->connection(ConfigService::$databaseConnectionName);
    }

    /**
     * @param callable $callback
     * @return mixed
     */
    public function transaction(callable $callback)
    {
        return $this->connection()->transaction($callback);
    }

    /**
     * @param Request $request
     * @return int|null
     */
    public function getAuthenticatedUserId(Request $request)
    {
        return $request->user()->id ?? 1;
    }

    public function getUserLanguage()
    {
        $user_preference = $this->connection()->table(ConfigService::$tableUserPreference)->where('user_id', $this->getAuthenticatedUserId(\request()))->get()->first();
        return $user_preference['language_id'];
    }

    public function saveTranslation($translate)
    {
        $update = $this->connection()->table(ConfigService::$tableTranslations)->where(
            [
                'entity_type' => $translate['entity_type'],
                'entity_id' => $translate['entity_id'],
                'language_id' => $this->getUserLanguage()
            ]
        )->update(
            [
                'value' => $translate['value']
            ]
        );

        if(!$update) {

            $this->connection()->table(ConfigService::$tableTranslations)->insertGetId(
                [
                    'entity_type' => $translate['entity_type'],
                    'entity_id' => $translate['entity_id'],
                    'language_id' => $this->getUserLanguage(),
                    'value' => $translate['value']]
            );
        }
    }

    public function deleteTranslations($translate)
    {
        return $this->connection()->table(ConfigService::$tableTranslations)->where(
            [
                'entity_type' => $translate['entity_type'],
                'entity_id' => $translate['entity_id']
            ]
        )->delete();
    }

    protected function addTranslations($query)
    {
        $userLanguage = $this->getUserLanguage();
        $this->generateTranslationQuery($query, $query->from, $query->from, $userLanguage);

        foreach($query->joins as $joinClause) {
            $tableName = explode(' as ', $joinClause->table);
            if(in_array($tableName[0], ConfigService::$translatableTables)) {
                $alias = $tableName[0];
                if(isset($tableName[1])) {
                    $alias = $tableName[1];
                }
                $this->generateTranslationQuery($query, $alias, $tableName[0], $userLanguage);
            }
        }
        return $query;
    }

    /**
     * @param $query
     * @param $joinClause
     */
    private function generateTranslationQuery($query, $joinClauseTable, $table, $userLanguage)
    {
        $query->leftJoin(ConfigService::$tableTranslations.' as translation_'.$joinClauseTable, function($join) use ($joinClauseTable, $userLanguage, $table) {
            $join->on('translation_'.$joinClauseTable.'.entity_id', '=', $joinClauseTable.'.id')
                ->where('translation_'.$joinClauseTable.'.entity_type', $table)
                ->where('translation_'.$joinClauseTable.'.language_id', '=', $userLanguage);
        });

        $query->addSelect('translation_'.$joinClauseTable.'.value as translation_'.$joinClauseTable.'_value');
    }
}