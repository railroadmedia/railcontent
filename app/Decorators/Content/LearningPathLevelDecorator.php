<?php

namespace App\Decorators\Content;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Support\Collection;

class LearningPathLevelDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     *
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'learning-path-level');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            // level number
            $contentsOfType[$contentIndex]['level_number'] = $contentsOfType[$contentIndex]['level_position'] = $content['hierarchy_position_number'];

            // course count
            $contentsOfType[$contentIndex]['lesson_count'] =$content['child_count'];

            // next lesson
            // todo:

            if (!empty($nextLesson['current_lesson'])) {
                $contentsOfType[$contentIndex]['next_lesson'] = $nextLesson['current_lesson'];
                $contentsOfType[$contentIndex]['current_lesson'] = $nextLesson['current_lesson'];
            }

            //thumb url
            $contentsOfType[$contentIndex]['thumbnail_url'] = $content->fetch('data.thumbnail_url', '');
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }

    /**
     * @return \Illuminate\Database\ConnectionInterface
     */
    private function railcontentDB()
    {
        return DB::connection(config('railcontent.database_connection_name'));
    }
}
