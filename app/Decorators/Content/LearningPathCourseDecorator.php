<?php

namespace App\Decorators\Content;

use Doctrine\ORM\NonUniqueResultException;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Support\Collection;

class LearningPathCourseDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return array|mixed|Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'learning-path-course');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            // lesson count & total length in seconds
            $childrenData =
                $this->railcontentDB()
                    ->table('railcontent_content_hierarchy as ch_1')
                    ->select(
                        DB::raw('SUM(cf_2.value) as total_length_in_seconds, COUNT(cf_2.id) as lesson_count ')

                    )
                    ->join('railcontent_content_fields as cf', 'cf.content_id', '=', 'ch_1.child_id')
                    ->join('railcontent_content_fields as cf_2', 'cf_2.content_id', '=', 'cf.value')
                    ->where('ch_1.parent_id', $content['id'])
                    ->where('cf.key', 'video')
                    ->where('cf_2.key', 'length_in_seconds')
                    ->groupBy('ch_1.parent_id')
                    ->first();

            $contentsOfType[$contentIndex]['total_length_in_seconds'] = $childrenData->total_length_in_seconds ?? 0;
            $contentsOfType[$contentIndex]['lesson_count'] = $childrenData->lesson_count ?? 0;

            //thumb url
            $contentsOfType[$contentIndex]['thumbnail_url'] =
                $contentsOfType[$contentIndex]->fetch('data.thumbnail_url', '');
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            // xp
            $contentsOfType[$contentIndex]['xp'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.learning_path_course_content_completed')
            );

            // current lesson (first child content that is not complete)
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
                                        $builder->where('railcontent_user_content_progress.user_id', auth()->id());
                                    }
                                );
                        }
                    )
                    ->where('parent_id', $content['id'])
                    ->orderBy('railcontent_content_hierarchy.child_position', 'asc')
                    ->get();

            $nextLesson = null;

            foreach ($childProgressRows as $childProgressRow) {
                if ($childProgressRow->state != 'completed' && $childProgressRow->progress_percent != 100) {
                    MultiPartParentDecorator::$off = true;
                    $nextLesson = $this->contentService->getById($childProgressRow->child_id);
                    MultiPartParentDecorator::$off = false;

                    break;
                }
            }

            $contentsOfType[$contentIndex]['current_lesson'] = $nextLesson;
            $contentsOfType[$contentIndex]['course_position'] = $contentsOfType[$contentIndex]['sort'];
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }

    /**
     * @return ConnectionInterface
     */
    private function railcontentDB()
    {
        return DB::connection(config('railcontent.database_connection_name'));
    }
}
