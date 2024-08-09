<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Support\Collection;

class StudentFocusDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents): Collection
    {
        $contentsOfType = $contents->where('type', 'student-focus');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            if (!isset($contentsOfType[$contentIndex]['xp'])) {
                $contentsOfType[$contentIndex]['xp'] = 0;
            }

            if (!isset($contentsOfType[$contentIndex]['xp_bonus'])) {
                $contentsOfType[$contentIndex]['xp_bonus'] = 0;
            }

            $contentsOfType[$contentIndex]['xp'] += $content->fetch(
                'fields.xp',
                config('xp_ranks.difficulty_xp_map')[$content->fetch('fields.difficulty')]
                ??
                config('xp_ranks.difficulty_xp_map.all')
            );

            $contentsOfType[$contentIndex]['xp_bonus'] += $content->fetch(
                'fields.xp',
                config('xp_ranks.difficulty_xp_map')[$content->fetch('fields.difficulty')]
                ??
                config('xp_ranks.difficulty_xp_map.all')
            );
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
