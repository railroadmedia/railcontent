<?php

namespace Railroad\Railcontent\Entities;

class ContentEntity extends Entity
{
    public function dot()
    {
        $data = $this->getArrayCopy();

        $fieldDots = [];
        $datumDots = [];

        // fields
        foreach ($data['fields'] as $fieldIndex => $field) {
            $fieldDots['*fields'] = $data['fields'];

            if (isset($field['value']['id'])) {

                // linked contents
                $linkedContentDots = (new ContentEntity($field['value']))->dot();
                $fieldDots['*fields.' . $field['key']][] = $field['value'];

                foreach ($linkedContentDots as $linkedContentDotKey => $linkedContentDotValue) {
                    if ($field['position'] == 1) {
                        $fieldDots['fields.' . $field['key'] . '.' . $linkedContentDotKey] = $linkedContentDotValue;
                    }

                    $fieldDots['fields.' . $field['key'] . '.' . $field['position'] . '.' . $linkedContentDotKey] =
                        $linkedContentDotValue;
                    $fieldDots['fields.' . $field['key'] . '.' . $field['position']] =
                        $field['value'];

                    $fieldDots['fields.' . $field['key'] . '.' . $field['type'] . '.' .
                    $field['position'] . '.' . $linkedContentDotKey] = $linkedContentDotValue;
                }
            } else {

                // regular fields
                if ($field['position'] == 1) {
                    $fieldDots['fields.' . $field['key']] = $field['value'];
                }

                $fieldDots['*fields.' . $field['key']][] = $field;
                $fieldDots['*fields.' . $field['key'] . '.' . $field['position']] = $field;
                $fieldDots['*fields.' . $field['key'] . '.' . 'value'][] = $field['value'];

                $fieldDots['fields.' . $field['key'] . '.' . $field['position']] = $field['value'];
                $fieldDots['fields.' . $field['key'] . '.' . $field['type'] . '.' . $field['position']] = $field['value'];
            }

            // make sure we can access all columns
            foreach ($field as $fieldColumnName => $fieldColumnValue) {
                if (is_array($fieldColumnValue)) {
                    continue;
                }

                if ($field['position'] == 1) {
                    $fieldDots['fields.' . $field['key'] . '.' . $fieldColumnName] = $fieldColumnValue;
                }

                $fieldDots['fields.' . $field['key'] . '.' . $field['position'] . '.' . $fieldColumnName] =
                    $fieldColumnValue;
                $fieldDots['fields.' . $field['key'] . '.' . $field['type'] .
                '.' . $field['position'] . '.' . $fieldColumnName] = $fieldColumnValue;
            }
        }

        // data
        foreach ($data['data'] as $dataIndex => $datum) {
            $fieldDots['*data'] = $data['data'];

            if ($datum['position'] == 1) {
                $datumDots['data.' . $datum['key']] = $datum['value'];
                $datumDots['*data.' . $datum['key']] = $datum;
            }

            $datumDots['data.' . $datum['key'] . '.' . $datum['position']] = $datum['value'];
            $datumDots['*data.' . $datum['key'] . '.' . $datum['position']] = $datum;
            $fieldDots['*data.' . $datum['key'] . '.' . 'value'][] = $datum['value'];

            foreach ($datum as $datumColumnName => $datumColumnValue) {
                if ($datum['position'] == 1) {
                    $datumDots['data.' . $datum['key'] . '.' . $datumColumnName] = $datumColumnValue;
                }

                $datumDots['data.' . $datum['key'] . '.' . $datum['position'] . '.' . $datumColumnName] =
                    $datumColumnValue;
            }
        }

        // permissions
        foreach ($data['permissions'] as $permissionsIndex => $permission) {
            foreach ($permission as $permissionColumnName => $permissionColumnValue) {
                $datumDots['permissions.' . $permission['name'] . '.' . $permissionColumnName] = $permissionColumnValue;
            }
        }

        unset($data['fields']);
        unset($data['data']);
        unset($data['permissions']);

        return array_merge($this->dotKeepFullArrays($data, '', '*'), $fieldDots, $datumDots);
    }

    /**
     * Flatten a multi-dimensional associative array with dots.
     *
     * @param  array $array
     * @param  string $prepend
     * @param $arrayPrepend
     * @return array
     */
    private function dotKeepFullArrays($array, $prepend = '', $arrayPrepend)
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results = array_merge(
                    $results,
                    $this->dotKeepFullArrays($value, $prepend . $key . '.', $arrayPrepend . $key . '.')
                );
                $results[$arrayPrepend . $key] = $value;
            } else {
                $results[$prepend . $key] = $value;
            }
        }

        return $results;
    }
}