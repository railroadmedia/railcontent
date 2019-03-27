<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\PersistentCollection;

abstract class ArrayExpressible
{
    /**
     * @param $dotNotationString
     * @param string $default
     * @return string
     */
    public function fetch($dotNotationString, $default = '')
    {
        return $this->dot()[$dotNotationString] ?? $default;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     */
    public function dot()
    {
        $arr = $this->toArray();

        foreach ($arr as $key => $value) {

            if ($value instanceof PersistentCollection) {

                if ($value->isEmpty()) {
                    $arr[$key] = [];
                    continue;
                }

                $prefix = 'fields.';
                $propertyName = $key;
                $getterMethodName = 'get' . ucfirst($key);

                foreach ($value as $dataIndex => $elem) {

                    if ($elem instanceof ContentData) {
                        $prefix = 'data.';
                        $propertyName = $elem->getKey();
                        $propertyValue = $elem->getValue();
                    } else {
                        $propertyValue = $elem->$getterMethodName();
                    }

                    if ($elem->getPosition() == 1) {
                        $datumDots[$prefix . $propertyName] = $propertyValue;
                    }

                    $datumDots[$prefix . '*.' . $propertyName][] = $elem->toArray();
                    $datumDots[$prefix . $propertyName . '.' . $elem->getPosition()] = $propertyValue;
                    $datumDots[$prefix . '*.' . $propertyName . '.' . $elem->getPosition()] = $elem->toArray();

                    foreach ($elem as $datumColumnName => $datumColumnValue) {
                        if ($elem->getPosition() == 1) {
                            $datumDots[$prefix . $propertyName . '.' . $datumColumnName] = $datumColumnValue;
                        }
                        $datumDots[$prefix . $propertyName . '.' . $elem->getPosition() . '.' . $datumColumnName] =
                            $datumColumnValue;
                    }

                    unset($arr[$key]);

                    $arr = array_merge($arr, $datumDots);
                }
            } elseif ($value instanceof ContentInstructor) {

                $instructor = $value->getInstructor();

                $fieldDots['fields.instructor'] = $instructor->dot();
                $fieldDots['fields.*.instructor'] = [$instructor->dot()];
                $fieldDots['fields.instructor.' . $value->getPosition()] = $instructor->dot();

                unset($arr[$key]);

                $arr = array_merge($arr, $fieldDots);
            }
        }

        if (isset($arr['permissions'])) {

            foreach ($arr['permissions'] as $contentPermission) {
                $permission = $contentPermission->getPermission();
                $permissionDots['permissions.' . $permission->getName()] = $permission->toArray();
            }

            $arr['permissions'] = $permissionDots ?? [];
        }

        if (isset($arr['video'])) {
            $arr['fields.video'] = $arr['video']->dot();
            unset($arr['video']);
        }

        return $arr;
    }
}