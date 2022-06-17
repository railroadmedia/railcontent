<?php

namespace Railroad\Railcontent\Transformers;

class TopicTransformer
{
    public function transform($data)
    {
        if (is_null($data) || empty($data)) {
            return [];
        }

        $results = [];
        foreach ($data as $topic) {
            $results[$topic['content_id']] = [
                'id' => $topic['id'] ?? null,
                'content_id' => $topic['content_id'],
                'key' => 'topic',
                'value' => $topic['topic'],
                'type' => 'string',
                'position' => $topic['position']
            ];
        }

        return $results;
    }
}