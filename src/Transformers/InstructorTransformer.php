<?php

namespace Railroad\Railcontent\Transformers;

class InstructorTransformer
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
        $results = [];
        foreach ($data as $instructor) {
            foreach ($fieldsColumns as $column) {
                if (array_key_exists($column, $instructor) && $instructor[$column] != '') {
                    $fields[$instructor['id']][] = [
                        "content_id" => $instructor['id'],
                        "key" => $column,
                        "value" => $instructor[$column] ?? '',
                        "type" => "string",
                        "position" => 1,
                    ];
                }
            }

            $results[$instructor['content_id']] = [
                'id' => $instructor['id'] ?? null,
                'slug' => $instructor['slug'] ?? '',
                'status' => $instructor['status'] ?? '',
                'type' => $instructor['type'] ?? '',
                'fields' => $fields[$instructor['id']]??[],
                'data' => $this->params['data'][$instructor['id']] ?? [],
                'permissions' => $instructor['permissions'] ?? [],
                'published_on' => $instructor['published_on'] ?? null,
                'content_id' => $instructor['content_id'],
                'position' => $instructor['position'],
            ];
        }

        return $results;
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
}