<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class LanguageRepository extends RepositoryBase
{
    /** Get the preference language saved in the database for the authenticated user
     * @return integer - user language id
     */
    public function getUserLanguage()
    {
        $user_preference = $this->connection()->table(ConfigService::$tableUserLanguagePreference)->where(
            [
                'user_id' => $this->getAuthenticatedUserId(request())
            ]
        )->get()->first();

        return $user_preference['language_id'];
    }

    /** Set the preference language for the authenticated user
     * If in the database dows not exist a language with the locale return a 403 page with the appropriate message
     * @param string $locale
     * @return bool|void
     */
    public function setUserLanguage($locale)
    {
        $userId = $this->getAuthenticatedUserId(request());

        $language = $this->connection()->table(ConfigService::$tableLanguage)->where(
            [
                'locale' => $locale
            ]
        )->get()->first();

        //check if the locale it's supported by the CMS
        if(!$language) {
            return false;
        }

        $this->connection()->table(ConfigService::$tableUserLanguagePreference)->updateOrInsert(
            [
                'user_id' => $userId
            ],
            [
                'language_id' => $language['id']
            ]
        );

        return true;
    }

    /** Insert/Update a record in translations table.
     * The translation table contain the following columns:
     *    id - autoincrement
     *    entity_type - contain the table name for the translatable value
     *    entity_id - contain the entity id
     *    language_id - contain the language for the translation
     *    value - the entity value (e.g: can be content slug, field value, datum value, playlist name, permission name)
     *
     * @param array $translate
     */
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

    /** Delete a record from the translations table
     * @param array $translate
     * @return int
     */
    public function deleteTranslations($translate)
    {
        return $this->connection()->table(ConfigService::$tableTranslations)->where(
            [
                'entity_type' => $translate['entity_type'],
                'entity_id' => $translate['entity_id']
            ]
        )->delete();
    }

    /** Based on QueryBuilder object, links(join) to the translation table are generated.
     * In the configuration file we have an array with the translatable tables; only for these tables are the joins generated
     * @param $query
     * @return mixed
     */
    protected function addTranslations($query)
    {
        //get language id for the authenticated user
        $userLanguage = $this->getUserLanguage();

        //generate join with the translation table for the FROM table
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

    /** Update the Query Builder object with the links to the translation table
     * @param Builder $query
     * @param string $joinClauseTable
     * @param string $table
     * @param int $userLanguage
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