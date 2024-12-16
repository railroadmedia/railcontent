<?php

namespace App\Decorators\Content;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Support\Collection;

class LearningPathCourseDecorator extends TypeDecoratorBase
{
    /**
     * @return array|mixed|Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'learning-path-course');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            // course number
            $contentsOfType[$contentIndex]['course_position'] = $content['hierarchy_position_number'];

            // course count
            $contentsOfType[$contentIndex]['lesson_count'] = $content['child_count'];

            //thumb url
            $contentsOfType[$contentIndex]['thumbnail_url'] =
                $contentsOfType[$contentIndex]->fetch('data.thumbnail_url', '');

            if (!empty($content->getParentContentData()[0]->position)) {
                $contentsOfType[$contentIndex]['level_rank'] = $content->getParentContentData()[0]->position .
                    '.' .
                    $content['hierarchy_position_number'];

            }
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            // xp
            $contentsOfType[$contentIndex]['xp'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.learning_path_course_content_completed')
            );
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }

    private function railcontentDB(): ConnectionInterface
    {
        return DB::connection(config('railcontent.database_connection_name'));
    }
}
