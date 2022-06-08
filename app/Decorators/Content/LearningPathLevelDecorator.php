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
            //level number
            $hierarchy =
                $this->railcontentDB()
                    ->table('railcontent_content_hierarchy')
                    ->join(
                        'railcontent_content',
                        'railcontent_content_hierarchy.parent_id',
                        '=',
                        'railcontent_content.id'
                    )
                    ->where('child_id', $content['id'])
                    ->where('railcontent_content.type', 'learning-path')
                    ->first();
            $contentsOfType[$contentIndex]['level_number'] = $hierarchy->child_position;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            // course count
            $contentsOfType[$contentIndex]['lesson_count'] =
                $this->railcontentDB()
                    ->table('railcontent_content_hierarchy')
                    ->where('parent_id', $content['id'])
                    ->count('child_id');

            // next lesson
            $childProgressRows = [];

            if (!empty(user())) {
                $childProgressRows =
                    $this->railcontentDB()
                        ->table('railcontent_content_hierarchy')
                        ->leftJoin(
                            'railcontent_user_content_progress',
                            function (JoinClause $join) {
                                $join->on(
                                    'railcontent_user_content_progress.content_id',
                                    '=',
                                    'railcontent_content_hierarchy.child_id'
                                )
                                    ->where(
                                        function (Builder $builder) {
                                            $builder->where('railcontent_user_content_progress.user_id', user()->id);
                                        }
                                    );
                            }
                        )
                        ->where('parent_id', $content['id'])
                        ->orderBy('railcontent_content_hierarchy.child_position', 'asc')
                        ->get();
            }

            $nextLesson = null;
            foreach ($childProgressRows as $childProgressRow) {
                if ($childProgressRow->state != 'completed' && $childProgressRow->progress_percent != 100) {
                    $nextLesson = $this->contentService->getById($childProgressRow->child_id);

                    break;
                }
            }

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
