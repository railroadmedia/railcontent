<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;
use Railroad\Resora\Entities\Entity;

class DefaultDifficultyDecorator extends ModeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        foreach ($contents as $contentIndex => $content) {
            if (!empty($content['user_id'])) {
                continue;
            }

            $hasDifficulty = false;

            foreach ($content['fields'] ?? [] as $field) {
                if ($field['key'] == 'difficulty' && !empty($field['value'])) {
                    $hasDifficulty = true;
                }
            }

            if (!$hasDifficulty) {
                $contents[$contentIndex]['fields'][] = new Entity([
                    'key' => 'difficulty',
                    'value' => 'all',
                    'type' => 'string',
                    'position' => 1
                ]);
            }
        }

        return $contents;
    }
}