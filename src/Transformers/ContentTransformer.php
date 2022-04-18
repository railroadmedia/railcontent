<?php

namespace Railroad\Railcontent\Transformers;

class ContentTransformer
{
    private $params;

    /**
     * @param $data
     * @return array
     */
    public function transform($data)
    {
        if (is_null($data) || empty($data)) {
            return [];
        }
        $fieldsColumns = config('railcontent.contentColumnNamesForFields', []);
        $associations = $this->includeAssociations();

        $results = [];

        if (!is_array($data[array_key_first($data)])) {
            $fields = [];
            foreach ($fieldsColumns as $column) {
                if ($column != 'video' && array_key_exists($column, $data) && $data[$column] != '') {
                    $fields[] = [
                        "content_id" => $data['id'],
                        "key" => $column,
                        "value" => $data[$column] ?? '',
                        "type" => "string",
                        "position" => 1,
                    ];
                }
            }

            $fields = array_merge($fields, $associations['fields'][$data['id']] ?? []);

            $content = [
                'id' => $data['id'] ?? null,
                'slug' => $data['slug'] ?? '',
                'status' => $data['status'] ?? '',
                'type' => $data['type'] ?? '',
                'fields' => $fields,
                'data' => $associations['data'][$data['id']] ?? [],
                'permissions' => $data['permissions'] ?? [],
                'published_on' => $data['published_on'] ?? null,
            ];
//            if ($data['type'] == 'instructor' || $data['type'] == 'coach') {
//                $content['name'] = $data['name'];
//            }
            $results = $content;
        } else {
            foreach ($data as $rowIndex => $row) {
                if (is_array($row) && (isset($row['id']))) {
                    $fields = [];
//dd($associations);
                    foreach ($fieldsColumns as $column) {
                        if ($column != 'video' && array_key_exists($column, $row) && $row[$column] != '') {
                            $fields[] = [
                                "content_id" => $row['id'],
                                "key" => $column,
                                "value" => $row[$column] ?? '',
                                "type" => "string",
                                "position" => 1,
                            ];
                        }
                    }

                    foreach($associations['fields']??[] as $value){
                        $fields = array_merge($fields, $value[$row['id']] ?? []);
                    }

                    $content = [
                        'id' => $row['id'] ?? null,
                        'slug' => $row['slug'] ?? '',
                        'type' => $row['type'] ?? '',
                        'fields' => $fields,
                        'data' => $associations['data'][$row['id']] ?? [],
                        'permissions' => $row['permissions'] ?? [],
                        'published_on' => $row['published_on'] ?? null,
                    ];
                    if ($row['type'] == 'instructor' || $row['type'] == 'coach') {
                        $content['name'] = $row['name'];
                    }

                    $results[] = $content;
                }
            }
        }

        $extraColumns = config('railcontent.contentColumnNamesForFields', []);

        foreach ($extraColumns as $extraColumn) {
            if (array_key_exists($extraColumn, $data)) {
                unset($data[$extraColumn]);
            }
        }

        return $results;
    }

    /**
     * @return array[]
     */
    public function includeAssociations()
    {
        $association = [
            'fields' => [],
            'data' => [],
        ];

        if (!empty($this->params)) {
            foreach ($this->params as $key => $value) {
                if ($key != 'data') {
                    //$fiedls = $association['fields'][$key] ?? [];

                    $association['fields'] = $association['fields'] +  $this->transformField($key, $value);
                } else {
                    $association['data'] = $value;
                }
            }
        }

        return $association;
    }

    public function addParam()
    {
        $args = func_get_args();

        if (is_array($args[0])) {
            $this->params = $args[0];
        } else {
            $this->params[$args[0]] = $args[1];
        }
    }

    /**
     * @param $key
     * @param $value
     * @return array
     */
    public function transformField($key, $value)
    {
        if (empty($value)) {
            return [];
        }

        if ($key == 'data') {
            $data = [];
            foreach ($value as $val) {
                $data[] = $val;
            }
            return $data;
        }
        $field = [];
        $field[$key] = [];
        if (is_array($value)) {
            foreach ($value as $val) {
                 $field[$key][$val['content_id']][] = [
                    'content_id' => $val['content_id'],
                    'key' => $key,
                    'position' => $val['position'] ?? 1,
                    'value' => $val,
                    'type' => 'content',
                ];
            }
        } else {
            $field[$key][$value['content_id']][] = [
                'content_id' => $value['content_id'],
                'key' => $key,
                'position' => $value['position'] ?? 1,
                'value' => $value,
                'type' => 'content',
            ];
        }

        return $field;
    }
}