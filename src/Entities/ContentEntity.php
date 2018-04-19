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

            if (isset($field['value']['id'])) {

                // linked contents
                $linkedContentDots = (new ContentEntity($field['value']))->dot();

                foreach ($linkedContentDots as $linkedContentDotKey => $linkedContentDotValue) {
                    if ($field['position'] == 1) {
                        $fieldDots['fields.' . $field['key'] . '.value.' . $linkedContentDotKey] = $linkedContentDotValue;
                    }

                    $fieldDots['fields.' . $field['key'] . '.value.' . $field['position'] . '.' . $linkedContentDotKey] =
                        $linkedContentDotValue;

                    $fieldDots['fields.' . $field['key'] . '.value.' . $field['type'] . '.' .
                    $field['position'] . '.' . $linkedContentDotKey] = $linkedContentDotValue;
                }
            } else {

                // regular fields
                if ($field['position'] == 1) {
                    $fieldDots['fields.' . $field['key']] = $field['value'];
                }

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
            if ($datum['position'] == 1) {
                $datumDots['data.' . $datum['key']] = $datum['value'];
            }

            $datumDots['data.' . $datum['key'] . '.' . $datum['position']] = $datum['value'];

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

        return array_merge(array_dot($data), $fieldDots, $datumDots);
    }
}