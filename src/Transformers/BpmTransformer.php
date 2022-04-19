<?php

namespace Railroad\Railcontent\Transformers;

class BpmTransformer
{
    public function transform($data)
    {
        if (is_null($data) || empty($data)) {
            return [];
        }

        $results = [];
        foreach ($data as $bpm) {
            $results[$bpm['content_id']] = [
                'id' => $bpm['id'] ?? null,
                'content_id' => $bpm['content_id'],
                'key' => 'bpm',
                'value' => $bpm['bpm'],
                'type' => 'string',
                'position' => $bpm['position']
            ];
        }

        return $results;
    }
}