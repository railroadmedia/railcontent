<?php

namespace Railroad\Railcontent\Transformers;

class TagTransformer
{
    public function transform($data)
    {
        if (is_null($data) || empty($data)) {
            return [];
        }

        $results = [];
        foreach ($data as $tag) {
            $results[$tag['content_id']][] = [
                'id' => $tag['id'] ?? null,
                'content_id' => $tag['content_id'],
                'key' => 'tag',
                'value' => $tag['tag'],
                'type' => 'string',
                'position' => $tag['position']
            ];
        }

        return $results;
    }
}