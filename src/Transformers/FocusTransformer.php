<?php

namespace Railroad\Railcontent\Transformers;

class FocusTransformer
{
    public function transform($data)
    {
        if (is_null($data) || empty($data)) {
            return [];
        }

        $results = [];
        foreach ($data as $focus) {
            $results[$focus['content_id']] = [
                'id' => $focus['id'] ?? null,
                'content_id' => $focus['content_id'],
                'key' => 'focus',
                'value' => $focus['focus'],
                'type' => 'string',
                'position' => $focus['position']
            ];
        }

        return $results;
    }
}