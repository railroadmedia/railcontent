<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\PersistentCollection;

abstract class ArrayExpressible
{
    private $cache = [];

    const CACHE_KEY_PREFIX = 'railcontent_fetch_';

    /**
     * @param $dotNotationString
     * @param string $default
     * @return mixed
     */
    public function fetch($dotNotationString, $default = '')
    {
        $hash = self::CACHE_KEY_PREFIX . $this->getId() . '_' . $dotNotationString;

        if (isset($this->cache[$hash])) {
            return $this->cache[$hash];
        }

        $results = $this->dot($dotNotationString) ?? $default;

        $this->cache[$hash] = $results;

        return $this->cache[$hash];
    }

    /**
     * @param $dotNotationString
     * @return array|mixed|null
     */
    public function dot($dotNotationString)
    {
        $dotNotationString = str_replace('fields.', '', $dotNotationString);

        $criteria = explode('.', $dotNotationString);

        $isData = ($criteria[0] == 'data' || $criteria[0] == '*data');

        $results = ($isData) ? $this->fetchData($this->getData(), $criteria) : $this->fetchField($this, $criteria);

        return $results;
    }

    /**
     * @param $contentData
     * @param $criteria
     * @param int $index
     * @return array|null
     */
    private function fetchData($contentData, $criteria, $index = 0)
    {
        $results = null;

        $allValues = in_array('*data', $criteria);

        $customPosition = false;

        if (is_numeric($criteria[count($criteria) - 1])) {
            $customPosition = $criteria[count($criteria) - 1];
        }


        for ($i = $index; $i < count($criteria); $i++) {
             foreach ($contentData as $data) {
                if ($data->getKey() == $criteria[$i]) {
                    if ($allValues) {
                        $results[] = $data->getValue();
                    } else {
                        if ($customPosition) {
                            if ($data->getPosition() == $customPosition) {
                                $results = $data->getValue();
                            }
                        } else {
                            $results = $data->getValue();
                        }
                    }
                }
            }
        }

        return $results;
    }

    /**
     * @param $fields
     * @param $criteria
     * @param int $index
     * @return array|mixed|null
     */
    private function fetchField(&$fields, $criteria, $index = 0)
    {
        $results = null;

        $allValues = str_contains($criteria[0], '*');
        $criteria[0] = str_replace('*', '', $criteria[0]);
        $customPosition = false;

        if (is_numeric($criteria[count($criteria) - 1])) {
            $customPosition = $criteria[count($criteria) - 1];
            unset($criteria[count($criteria) - 1]);
        }

        for ($i = $index; $i < count($criteria); $i++) {

            if ($criteria[$i] == 'data') {

                return $this->fetchData($fields->getData(), $criteria, $i);

            } else {

                $getterName = Inflector::camelize('get' . ucwords($criteria[$i]));

                if (method_exists($fields, $getterName)) {

                    $fields = call_user_func([$fields, $getterName]);

                    if ($fields instanceof PersistentCollection) {
                        foreach ($fields as $field) {
                            if ($allValues) {
                                $results[] = $this->fetchField($field, $criteria, $i);
                            } else {
                                if ($customPosition) {
                                    if ($field->getPosition() == $customPosition) {
                                        $results = $this->fetchField($field, $criteria, $i);
                                    }
                                } else {
                                    $results = $this->fetchField($field, $criteria, $i);
                                }
                            }
                        }
                        return $results;
                    }

                    $results = $fields;

                    if (!$results) {
                        return $results;
                    }

                    if (($fields instanceof ContentInstructor)) {

                    if($allValues){
                        $results = $fields = [call_user_func([$fields, $getterName])];
                    } else{
                        $results = $fields = call_user_func([$fields, $getterName]);
                    }
                    }
                } else {
                    $extraProperties = $fields->getExtra();

                    if ($extraProperties && array_key_exists($criteria[$i], $extraProperties)) {
                        $results = $fields =  $fields->getProperty($criteria[$i]);
                    } else {
                        return null;
                    }

                    //decorate extra properties
                    if (is_array($results) && !empty($results)) {
                        if (is_object(array_first($results))) {
                            $className = ClassUtils::getRealClass(get_class(array_first($results)));
                            $allDecorators = config('railcontent.decorators')[$className] ?? [];

                            foreach ($allDecorators as $decorator) {
                                $decoratorInstance = app()->make($decorator);
                                $decoratorInstance->decorate($results);
                            }
                        }
                    }
                }
            }
        }

        return $results;
    }
}
