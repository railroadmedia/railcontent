<?php

namespace App\Decorators\Content;

use Doctrine\ORM\NonUniqueResultException;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Support\Collection;

class DrumeoMethodLearningPathDecorator extends TypeDecoratorBase
{
    public static $skip = false;

    /**
     * @param Collection $contents
     * @return mixed|Collection
     */
    public function decorate(Collection $contents)
    {
        if (self::$skip) {
            return $contents;
        }

        $contentsOfType = $contents->where('type', 'learning-path')->where('slug', 'drumeo-method');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        $oldPullFutureContent = ContentRepository::$pullFutureContent;
        ContentRepository::$pullFutureContent = true;

        foreach ($contentsOfType as $contentIndex => $content) {
            $userProgress = $this->userContentProgressService->getUserProgressOnContent(auth()->id(), $content['id']);

            $contentsOfType[$contentIndex]['level_rank'] = $userProgress['higher_key_progress'] ?? '1.1';
        }

        $lessons = $this->contentService->getByParentIds(
            $contentsOfType->pluck('id')
                ->toArray()
        )
            ->groupBy('parent_id');

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['url'] = url()->route('members.learning-path.show', [$content['slug']]);
            $contentsOfType[$contentIndex]['levels'] = $lessons[$content['id']] ?? [];
            $contentsOfType[$contentIndex]['xp'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.learning_path_content_completed')
            );

            $contentsOfType[$contentIndex]['xp_bonus'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.learning_path_content_completed')
            );

            /**
             * @var $lesson ContentEntity
             */
            foreach ($contentsOfType[$contentIndex]['levels'] as $lessonIndex => $lesson) {
                $contentsOfType[$contentIndex]['xp'] += $lesson->fetch(
                    'xp',
                    config('xp_ranks.difficulty_xp_map')[$lesson->fetch('fields.difficulty')]
                    ??
                    config('xp_ranks.difficulty_xp_map.all')
                );
            }

            $userHigherKeyProgress = explode('.', $contentsOfType[$contentIndex]['level_rank']);

            $currentLevelIndex = $userHigherKeyProgress[0] - 1;
            $currentCourseIndex = $userHigherKeyProgress[1] - 1;

            if (empty($content['levels'][$currentLevelIndex])) {
                return $this->mergeDecorated($contents, $contentsOfType);
            }

            $lessonsProgressRows =
                $this->railcontentDB()
                    ->table('railcontent_content_hierarchy as ch_1')
                    ->select(
                        [
                            'ch_1.parent_id as level_id',
                            'ch_2.parent_id as course_id',
                            'ch_2.child_id as lesson_id',
                            'ch_2.child_position as lesson_position',

                            'up.state as state',
                            'up.progress_percent as progress_percent',
                        ]
                    )
                    ->join('railcontent_content_hierarchy as ch_2', 'ch_2.parent_id', '=', 'ch_1.child_id')
                    ->leftJoin(
                        'railcontent_user_content_progress as up',
                        function (JoinClause $join) {
                            $join->on(
                                'up.content_id',
                                '=',
                                'ch_2.child_id'
                            )
                                ->where(
                                    function (Builder $builder) {
                                        $builder->where('up.user_id', auth()->id());
                                    }
                                );
                        }
                    )
                    ->where('ch_1.parent_id', $content['levels'][$currentLevelIndex]['id'])
                    ->where('ch_1.child_position', ($currentCourseIndex + 1))
                    ->orderBy('ch_2.child_position', 'asc')
                    ->get();

            $nextLesson = null;

            foreach ($lessonsProgressRows as $childProgressRow) {
                if ($childProgressRow->state != 'completed' && $childProgressRow->progress_percent != 100) {

                    $nextLesson = $this->contentService->getById($childProgressRow->lesson_id);

                    $contentsOfType[$contentIndex]['next_lesson_course_id'] = $childProgressRow->course_id;
                    $contentsOfType[$contentIndex]['next_lesson_level_id'] = $childProgressRow->level_id;
                    $contentsOfType[$contentIndex]['lesson_rank'] =  $childProgressRow->lesson_position;
                    break;
                }
            }

            $contentsOfType[$contentIndex]['next_lesson'] = $contentsOfType[$contentIndex]['current_lesson'] = $nextLesson;
        }

        ContentRepository::$pullFutureContent = $oldPullFutureContent;
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
