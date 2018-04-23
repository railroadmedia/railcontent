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

            $exists = $this->databaseManager->connection($connection)
                ->table($table)
                ->where($row, $value)
                ->exists();

            if($exists || $or){

                if(isset($parameters[$key - 1])){

                    /*
                     * If we're currently on the first (or only) item in this looping through the "$parameters" then
                     * we can operate on the previous item.
                     */
                    $previousParameter = &$parameters[$key - 1];

                    if(!$previousParameter['pass'] && $exists){
                        /*
                         * If the previous is false, and this one is true, then we want to set the previous to true so
                         * that the false is not returned below.
                         */
                        $previousParameter['pass'] = true;
                    }
                    if($previousParameter['pass'] && !$exists) {
                        /*
                         * If the previous is true, but the current one is false, then set the current one to true
                         * because it's allowed to pass because one of the "or" conditions was passed.
                         */
                        $exists = true;
                    }
                }
            }

            $parameter = ['pass' => $exists];
        }

        foreach ($parameters as &$parameter) {
            if(!$parameter['pass']){
                return '0';
            };
        }

        return true;
    }
}