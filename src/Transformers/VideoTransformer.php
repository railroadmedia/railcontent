<?php

namespace Railroad\Railcontent\Transformers;

class VideoTransformer
{
    private $params;

    public function transform($data)
    {
        if (is_null($data) || empty($data)) {
            return [];
        }

        $fieldsColumns = config('railcontent.contentColumnNamesForFields', []);
        $results = [];
        $fields = [];

        foreach ($data as $video) {
            foreach ($fieldsColumns as $column) {
                if (array_key_exists($column, $video) && $video[$column] != '') {
                    $fields[$video['id']][] = [
                        "content_id" => $video['id'],
                        "key" => $column,
                        "value" => $video[$column] ?? '',
                        "type" => "string",
                        "position" => 1,
                    ];
                }
            }

            $results[$video['content_id']] = [
                'id' => $video['id'] ?? null,
                'slug' => $video['slug'] ?? '',
                'status' => $video['status'] ?? '',
                'type' => $video['type'] ?? '',
                'fields' => $fields[$video['id']] ?? [],
                'data' => $video['data'] ?? [],
                'permissions' => $video['permissions'] ?? [],
                'published_on' => $video['published_on'] ?? null,
                'content_id' => $video['content_id'],
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