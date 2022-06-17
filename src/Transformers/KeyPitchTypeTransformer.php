<?php

namespace Railroad\Railcontent\Transformers;

class KeyPitchTypeTransformer
{
    public function transform($data)
    {
        if (is_null($data) || empty($data)) {
            return [];
        }

        $results = [];
        foreach ($data as $item) {
            $results[$item['content_id']] = [
                'id' => $item['id'] ?? null,
                'content_id' => $item['content_id'],
                'key' => 'key_pitch_type',
                'value' => $item['key_pitch_type'],
                'type' => 'string',
                'position' => $item['position']
            ];
        }

        return $results;
    }
}