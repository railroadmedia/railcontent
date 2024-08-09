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
    public function decorate(Collection $contents): Collection
    {
        foreach ($contents as $contentIndex => $content) {
            if (!empty($content['user_id'])) {
                continue;
            }

            $hasDifficulty = false;
            $difficulty = '';

            foreach ($content['fields'] ?? [] as $field) {
                if ($field['key'] == 'difficulty' && !empty($field['value'])) {
                    $hasDifficulty = true;
                    $difficulty = is_numeric($field['value']) ? (int)$field['value'] : $field['value'];
                }
            }

            if (!$hasDifficulty) {
                $contents[$contentIndex]['fields'][] = new Entity([
                    'key' => 'difficulty',
                    'value' => 'all',
                    'type' => 'string',
                    'position' => 1
                ]);
                $contents[$contentIndex]['difficulty_string'] = 'All';
            } else {
                $contents[$contentIndex]['difficulty_string'] = $difficulty;
                if (!is_string($difficulty)) {
                    if ($difficulty == 1) {
                        $contents[$contentIndex]['difficulty_string'] = 'Introductory';
                    }
                    if ($difficulty > 1 && $difficulty <= 3) {
                        $contents[$contentIndex]['difficulty_string'] = 'Beginner';
                    }
                    if ($difficulty > 3 && $difficulty <= 6) {
                        $contents[$contentIndex]['difficulty_string'] = 'Intermediate';
                    }
                    if ($difficulty > 6 && $difficulty <= 9) {
                        $contents[$contentIndex]['difficulty_string'] = 'Advanced';
                    }
                    if ($difficulty > 9) {
                        $contents[$contentIndex]['difficulty_string'] = 'Expert';
                    }
                }
            }
        }

        return $contents;
    }
}
