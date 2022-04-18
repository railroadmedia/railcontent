<?php

namespace Railroad\Railcontent\Transformers;

class StyleTransformer
{
    public function transform($data)
    {
        if (is_null($data) || empty($data)) {
            return [];
        }

        $results = [];
        foreach ($data as $style) {
            $results[$style['content_id']] = [
                'id' => $video['id'] ?? null,
                'content_id' => $style['content_id'],
                'key' => 'style',
                'value' => $style['style'],
                'type' => 'string',
                'position' => $style['position']
            ];
        }

        return $results;
    }
}